<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Models\RideOffer;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RideMatchingController extends Controller
{
    /**
     * Match nearby drivers to a ride request and create ride offers.
     * Returns the first available driver offer.
     */
    public function matchAndOffer(Request $request)
    {
        $request->validate([
            'ride_request_id' => 'required|exists:ride_requests,id',
        ]);

        $rideRequest = RideRequest::findOrFail($request->ride_request_id);

        // Ensure the ride belongs to the authenticated user
        if ($rideRequest->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        // Ensure ride is still pending
        if ($rideRequest->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This ride request is no longer pending',
                'status' => $rideRequest->status
            ], 400);
        }

        $lat = $rideRequest->pickup_latitude;
        $lng = $rideRequest->pickup_longitude;
        $radius = 10; // Search within 10km

        // Get IDs of drivers already offered this ride (includes pending to avoid re-offering)
        $alreadyOfferedDriverIds = RideOffer::where('ride_request_id', $rideRequest->id)
            ->whereIn('status', ['pending', 'declined', 'expired'])
            ->pluck('driver_id')
            ->toArray();

        // Find nearby active, online drivers who have NOT been offered yet
        $nearbyDrivers = Driver::select('id', 'name', 'latitude', 'longitude', 'mobile', 'vehicle_type')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
                [$lat, $lng, $lat]
            )
            ->where('status', 1)        // Active driver
            ->where('is_online', true)    // Currently online
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereNotIn('id', $alreadyOfferedDriverIds)
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->limit(5) // Offer to nearest 5 drivers at a time
            ->get();

        if ($nearbyDrivers->isEmpty()) {
            // No more available drivers — mark ride as cancelled by system
            $rideRequest->update([
                'status' => 'cancelled',
                'cancelled_by' => 'system',
                'cancellation_reason' => 'No available drivers found in your area',
            ]);

            return response()->json([
                'success' => false,
                'message' => 'No drivers available nearby',
                'no_drivers' => true,
            ], 404);
        }

        // Get the highest existing priority order for this ride
        $maxPriority = RideOffer::where('ride_request_id', $rideRequest->id)
            ->max('priority_order') ?? 0;

        $fcm = new \App\Services\FcmService();

        // Ride payload sent to each offered driver so their app can ring + show the call
        $ridePayload = [
            'request_id'      => (string) $rideRequest->id,
            'ride_request_id' => (string) $rideRequest->id,
            'trip_id'         => (string) ($rideRequest->firebase_trip_id ?? ''),
            'mysqlRideId'     => (string) $rideRequest->id,
            'rider_name'      => (string) ($rideRequest->user->name ?? 'Passenger'),
            'rider_phone'     => (string) ($rideRequest->user->mobile ?? ''),
            'ride_type'       => (string) ($rideRequest->ride_type ?? 'car'),
            'fare'            => (string) ($rideRequest->fare ?? 0),
            'pickup'          => (string) $rideRequest->pickup_address,
            'destination'     => (string) $rideRequest->destination_address,
            'pickup_lat'      => (string) $rideRequest->pickup_latitude,
            'pickup_lng'      => (string) $rideRequest->pickup_longitude,
            'dest_lat'        => (string) $rideRequest->destination_latitude,
            'dest_lng'        => (string) $rideRequest->destination_longitude,
        ];

        $offers = [];
        foreach ($nearbyDrivers as $i => $driver) {
            $offer = RideOffer::create([
                'ride_request_id' => $rideRequest->id,
                'driver_id' => $driver->id,
                'status' => 'pending',
                'offered_at' => now(),
                'priority_order' => $maxPriority + $i + 1,
            ]);

            // RING the driver's phone right now (works even if app is closed)
            $driverModel = Driver::find($driver->id);
            if ($driverModel) {
                $fcm->rideCallToDriver($driverModel, array_merge($ridePayload, [
                    'offer_id' => (string) $offer->id,
                ]));

                // Also store an in-app notification so this ride request shows
                // in the driver's notification bell list (the push above is
                // data-only and does not create a DB row on its own).
                \App\Models\Notification::create([
                    'user_id'        => $driverModel->id,
                    'recipient_type' => 'driver',
                    'title'          => '🔔 New Ride Request',
                    'message'        => "{$ridePayload['pickup']} → {$ridePayload['destination']} • ৳{$ridePayload['fare']}",
                    'type'           => 'ride_request',
                    'data'           => ['ride_request_id' => $rideRequest->id],
                    'all_show'       => false,
                ]);
            }

            $offers[] = [
                'offer_id' => $offer->id,
                'driver_id' => $driver->id,
                'driver_name' => $driver->name,
                'driver_mobile' => $driver->mobile,
                'distance_km' => round($driver->distance, 2),
                'priority_order' => $offer->priority_order,
            ];
        }

        // Return the first (nearest) driver offer to show to the driver
        $firstOffer = $offers[0];

        return response()->json([
            'success' => true,
            'message' => 'Found ' . count($offers) . ' nearby drivers',
            'offers_count' => count($offers),
            'current_offer' => $firstOffer,
            'all_offers' => $offers,
        ]);
    }

    /**
     * Driver responds to a ride offer (accept or decline).
     * If declined, automatically offers to the next nearest driver.
     */
    public function respondToOffer(Request $request, $offerId)
    {
        $request->validate([
            'response' => 'required|in:accept,decline',
        ]);

        $user = auth()->user();
        if ($user->role !== 'driver' || !isset($user->driver)) {
            return response()->json(['success' => false, 'message' => 'Only drivers can respond to offers'], 403);
        }

        $driverId = $user->driver->id;

        $offer = RideOffer::with('rideRequest')->findOrFail($offerId);

        // Verify this offer belongs to this driver
        if ($offer->driver_id != $driverId) {
            return response()->json(['success' => false, 'message' => 'This offer is not for you'], 403);
        }

        // Verify offer is still pending
        if ($offer->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'This offer has already been ' . $offer->status,
            ], 400);
        }

        $rideRequest = $offer->rideRequest;

        DB::beginTransaction();
        try {
            if ($request->response === 'accept') {
                // ── Driver accepts the offer ──
                // Use atomic update to prevent race conditions (two drivers accepting simultaneously)
                $updated = RideRequest::where('id', $rideRequest->id)
                    ->where('status', 'pending')
                    ->update([
                        'driver_id' => $driverId,
                        'status' => 'accepted',
                        'accepted_at' => now(),
                    ]);

                if ($updated === 0) {
                    // Ride was already accepted by another driver
                    $offer->update(['status' => 'expired', 'responded_at' => now()]);
                    DB::commit();
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, this ride was just accepted by another driver',
                    ], 409);
                }

                // Refresh the ride request to get updated data
                $rideRequest->refresh();

                $offer->update(['status' => 'accepted', 'responded_at' => now()]);

                // Mark all other pending offers for this ride as expired
                RideOffer::where('ride_request_id', $rideRequest->id)
                    ->where('status', 'pending')
                    ->where('id', '!=', $offer->id)
                    ->update(['status' => 'expired', 'responded_at' => now()]);

                // Update acceptance rate
                $this->updateAcceptanceRate($driverId, accepted: true);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Ride accepted successfully',
                    'data' => [
                        'ride_request_id' => $rideRequest->id,
                        'ride_status' => $rideRequest->status,
                        'driver_id' => $driverId,
                        'pickup_latitude' => $rideRequest->pickup_latitude,
                        'pickup_longitude' => $rideRequest->pickup_longitude,
                        'destination_latitude' => $rideRequest->destination_latitude,
                        'destination_longitude' => $rideRequest->destination_longitude,
                        'pickup_address' => $rideRequest->pickup_address,
                        'destination_address' => $rideRequest->destination_address,
                        'fare' => $rideRequest->fare,
                        'rider_name' => $rideRequest->user->name ?? 'Unknown',
                        'rider_mobile' => $rideRequest->user->mobile ?? '',
                    ]
                ]);
            } else {
                // ── Driver declines the offer ──
                $offer->update(['status' => 'declined', 'responded_at' => now()]);

                // Update acceptance rate
                $this->updateAcceptanceRate($driverId, accepted: false);

                DB::commit();

                // Now find and offer to the next available driver
                $nextOffer = $this->findAndOfferNextDriver($rideRequest);

                $response = [
                    'success' => true,
                    'message' => 'Offer declined. Searching for next driver...',
                    'declined' => true,
                ];

                if ($nextOffer) {
                    $response['next_driver'] = $nextOffer;
                    $response['message'] = 'Offer declined. Next driver has been notified.';
                } else {
                    $response['no_more_drivers'] = true;
                    $response['message'] = 'No more drivers available nearby. The ride has been cancelled.';
                }

                return response()->json($response);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Find and offer the ride to the next nearest driver.
     * Called automatically when a driver declines.
     */
    private function findAndOfferNextDriver($rideRequest)
    {
        // Re-fetch the ride to check if it's still pending (could have been accepted)
        $rideRequest->refresh();
        if ($rideRequest->status !== 'pending') {
            return null;
        }

        $lat = $rideRequest->pickup_latitude;
        $lng = $rideRequest->pickup_longitude;
        $radius = 10;

        // Get all drivers already offered (any status)
        $alreadyOfferedDriverIds = RideOffer::where('ride_request_id', $rideRequest->id)
            ->pluck('driver_id')
            ->toArray();

        // Find next nearest available driver
        $nextDriver = Driver::select('id', 'name', 'latitude', 'longitude', 'mobile', 'vehicle_type')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
                [$lat, $lng, $lat]
            )
            ->where('status', 1)
            ->where('is_online', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereNotIn('id', $alreadyOfferedDriverIds)
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->first();

        if (!$nextDriver) {
            // No more drivers available — cancel the ride
            $rideRequest->update([
                'status' => 'cancelled',
                'cancelled_by' => 'system',
                'cancellation_reason' => 'All nearby drivers declined or unavailable',
            ]);
            return null;
        }

        // Get max priority order
        $maxPriority = RideOffer::where('ride_request_id', $rideRequest->id)
            ->max('priority_order') ?? 0;

        // Create new offer for the next driver
        $newOffer = RideOffer::create([
            'ride_request_id' => $rideRequest->id,
            'driver_id' => $nextDriver->id,
            'status' => 'pending',
            'offered_at' => now(),
            'priority_order' => $maxPriority + 1,
        ]);

        // RING the next driver's phone (transfer the call to them)
        $driverModel = Driver::find($nextDriver->id);
        if ($driverModel) {
            (new \App\Services\FcmService())->rideCallToDriver($driverModel, [
                'request_id'      => (string) $rideRequest->id,
                'ride_request_id' => (string) $rideRequest->id,
                'mysqlRideId'     => (string) $rideRequest->id,
                'trip_id'         => (string) ($rideRequest->firebase_trip_id ?? ''),
                'offer_id'        => (string) $newOffer->id,
                'rider_name'      => (string) ($rideRequest->user->name ?? 'Passenger'),
                'rider_phone'     => (string) ($rideRequest->user->mobile ?? ''),
                'ride_type'       => (string) ($rideRequest->ride_type ?? 'car'),
                'fare'            => (string) ($rideRequest->fare ?? 0),
                'pickup'          => (string) $rideRequest->pickup_address,
                'destination'     => (string) $rideRequest->destination_address,
                'pickup_lat'      => (string) $rideRequest->pickup_latitude,
                'pickup_lng'      => (string) $rideRequest->pickup_longitude,
                'dest_lat'        => (string) $rideRequest->destination_latitude,
                'dest_lng'        => (string) $rideRequest->destination_longitude,
            ]);
        }

        return [
            'offer_id' => $newOffer->id,
            'driver_id' => $nextDriver->id,
            'driver_name' => $nextDriver->name,
            'distance_km' => round($nextDriver->distance, 2),
            'priority_order' => $newOffer->priority_order,
        ];
    }

    /**
     * Driver declines from the incoming-call screen. Marks their offer
     * declined and transfers the call to the next nearest driver.
     */
    public function declineAndTransfer(Request $request, $rideId)
    {
        $rideRequest = RideRequest::find($rideId);
        if (!$rideRequest) {
            return response()->json(['success' => false, 'message' => 'Ride not found'], 404);
        }

        $user = auth()->user();
        $driverId = ($user instanceof \App\Models\Driver)
            ? $user->id
            : (\App\Models\Driver::where('user_id', $user->id)->value('id'));

        // Mark this driver's pending offer as declined (so they aren't re-offered)
        if ($driverId) {
            RideOffer::where('ride_request_id', $rideRequest->id)
                ->where('driver_id', $driverId)
                ->where('status', 'pending')
                ->update(['status' => 'declined', 'responded_at' => now()]);
        }

        // Only transfer if still waiting for a driver
        if ($rideRequest->status === 'pending') {
            $next = $this->findAndOfferNextDriver($rideRequest);
            return response()->json([
                'success'    => true,
                'transferred' => $next !== null,
                'next_driver' => $next,
            ]);
        }

        return response()->json(['success' => true, 'transferred' => false]);
    }

    /**
     * Get all ride offers for a specific ride request.
     */
    public function rideOffers($rideRequestId)
    {
        $rideRequest = RideRequest::findOrFail($rideRequestId);

        // Only the rider or admin can view offers
        if ($rideRequest->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $offers = RideOffer::with('driver:id,name,mobile')
            ->where('ride_request_id', $rideRequestId)
            ->orderBy('priority_order')
            ->get()
            ->map(function ($offer) {
                return [
                    'offer_id' => $offer->id,
                    'driver_id' => $offer->driver_id,
                    'driver_name' => $offer->driver->name ?? 'Unknown',
                    'driver_mobile' => $offer->driver->mobile ?? '',
                    'status' => $offer->status,
                    'priority_order' => $offer->priority_order,
                    'offered_at' => $offer->offered_at,
                    'responded_at' => $offer->responded_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $offers,
        ]);
    }

    /**
     * Get ride history for the authenticated user (rider or driver).
     */
    /**
     * Aggregated dashboard stats for the authenticated passenger — powers the
     * customer "Account" dashboard (total trips, spend, wallet, member since).
     */
    public function riderStats(Request $request)
    {
        $user = auth()->user();

        $base = RideRequest::where('user_id', $user->id);
        $total     = (clone $base)->count();
        $completed = (clone $base)->where('status', 'completed')->count();
        $cancelled = (clone $base)->where('status', 'cancelled')->count();
        $totalSpent = (clone $base)->where('status', 'completed')
            ->sum(DB::raw('COALESCE(actual_fare, fare)'));

        $wallet = \App\Models\Wallet::where('user_id', $user->id)
            ->where('owner_type', 'user')->value('balance') ?? 0;

        return response()->json([
            'success' => true,
            'data' => [
                'total_trips'     => $total,
                'completed_trips' => $completed,
                'cancelled_trips' => $cancelled,
                'total_spent'     => (float) $totalSpent,
                'wallet_balance'  => (float) $wallet,
                'member_since'    => $user->created_at,
            ],
        ]);
    }

    public function rideHistory(Request $request)
    {
        $user = auth()->user();
        $perPage = $request->per_page ?? 20;
        $status = $request->status; // optional filter: completed, cancelled, all

        $query = RideRequest::with(['driver:id,name,mobile', 'user:id,name,mobile']);

        // The authenticated entity IS the Driver when logged in via the driver
        // guard — only fall back to $user->driver for a User with a linked row.
        if ($user instanceof \App\Models\Driver) {
            $query->where('driver_id', $user->id);
        } elseif ($user->role === 'driver' && $user->driver) {
            $query->where('driver_id', $user->driver->id);
        } else {
            $query->where('user_id', $user->id);
        }

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        $rides = $query->orderBy('created_at', 'desc')
            ->paginate($perPage);

        $rides->getCollection()->transform(function ($ride) {
            return [
                'id' => $ride->id,
                'ride_type' => $ride->ride_type,
                'pickup_address' => $ride->pickup_address,
                'destination_address' => $ride->destination_address,
                'fare' => (float) $ride->fare,
                'actual_fare' => $ride->actual_fare !== null ? (float) $ride->actual_fare : null,
                'status' => $ride->status,
                'payment_status' => $ride->payment_status,
                'payment_method' => $ride->payment_method,
                'distance_km' => $ride->distance_km,
                'duration_minutes' => $ride->duration_minutes,
                'cancelled_by' => $ride->cancelled_by,
                'cancellation_reason' => $ride->cancellation_reason,
                'driver' => $ride->driver ? [
                    'id' => $ride->driver->id,
                    'name' => $ride->driver->name,
                    'mobile' => $ride->driver->mobile,
                ] : null,
                'rider' => $ride->user ? [
                    'id' => $ride->user->id,
                    'name' => $ride->user->name,
                ] : null,
                'created_at' => $ride->created_at,
                'accepted_at' => $ride->accepted_at,
                'completed_at' => $ride->completed_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $rides->items(),
            'pagination' => [
                'current_page' => $rides->currentPage(),
                'last_page' => $rides->lastPage(),
                'per_page' => $rides->perPage(),
                'total' => $rides->total(),
            ],
        ]);
    }

    /**
     * Get detailed info for a single ride (for trip history detail view).
     */
    public function rideDetail($id)
    {
        $ride = RideRequest::with(['driver:id,name,mobile', 'user:id,name,mobile', 'offers' => function ($q) {
            $q->with('driver:id,name,mobile')->orderBy('priority_order');
        }])->findOrFail($id);

        $user = auth()->user();
        if ($ride->user_id !== $user->id &&
            ($user->role !== 'driver' || !$user->driver || $ride->driver_id !== $user->driver->id) &&
            $user->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $ride->id,
                'firebase_trip_id' => $ride->firebase_trip_id,
                'ride_type' => $ride->ride_type,
                'pickup_address' => $ride->pickup_address,
                'pickup_latitude' => $ride->pickup_latitude,
                'pickup_longitude' => $ride->pickup_longitude,
                'destination_address' => $ride->destination_address,
                'destination_latitude' => $ride->destination_latitude,
                'destination_longitude' => $ride->destination_longitude,
                'fare' => (float) $ride->fare,
                'actual_fare' => $ride->actual_fare !== null ? (float) $ride->actual_fare : null,
                'status' => $ride->status,
                'payment_status' => $ride->payment_status,
                'payment_method' => $ride->payment_method,
                'distance_km' => $ride->distance_km,
                'duration_minutes' => $ride->duration_minutes,
                'cancelled_by' => $ride->cancelled_by,
                'cancellation_reason' => $ride->cancellation_reason,
                'notes' => $ride->notes,
                'driver' => $ride->driver ? [
                    'id' => $ride->driver->id,
                    'name' => $ride->driver->name,
                    'mobile' => $ride->driver->mobile,
                ] : null,
                'rider' => $ride->user ? [
                    'id' => $ride->user->id,
                    'name' => $ride->user->name,
                    'mobile' => $ride->user->mobile,
                ] : null,
                'offers' => $ride->offers->map(function ($offer) {
                    return [
                        'offer_id' => $offer->id,
                        'driver_name' => $offer->driver->name ?? 'Unknown',
                        'status' => $offer->status,
                        'priority_order' => $offer->priority_order,
                        'offered_at' => $offer->offered_at,
                        'responded_at' => $offer->responded_at,
                    ];
                }),
                'created_at' => $ride->created_at,
                'accepted_at' => $ride->accepted_at,
                'started_at' => $ride->started_at,
                'completed_at' => $ride->completed_at,
            ],
        ]);
    }

    /**
     * Update ride payment info (called after trip completes).
     */
    public function updatePayment(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'sometimes|in:pending,paid,refunded',
            'payment_method' => 'sometimes|string|max:50',
            'actual_fare' => 'sometimes|numeric|min:0',
            'distance_km' => 'sometimes|numeric|min:0',
            'duration_minutes' => 'sometimes|integer|min:0',
        ]);

        $ride = RideRequest::findOrFail($id);

        // The assigned driver, the ride's passenger, or an admin may update
        // payment. Allowing the passenger is what makes cash/card settlement
        // reliable — they confirm payment in the app and Laravel is marked
        // paid immediately (which then credits the driver's earnings), instead
        // of depending on the driver's app being open to relay it.
        $user = auth()->user();
        $isDriver = ($user instanceof \App\Models\Driver && $user->id === $ride->driver_id)
            || (($user->role ?? null) === 'driver' && isset($user->driver) && $user->driver->id === $ride->driver_id);
        $isRider  = ($user instanceof \App\Models\User) && $user->id === $ride->user_id;
        $isAdmin  = ($user instanceof \App\Models\Admin) || ($user->role ?? null) === 'admin';
        if (!$isDriver && !$isRider && !$isAdmin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $updateData = [];
        foreach (['payment_status', 'payment_method', 'actual_fare', 'distance_km', 'duration_minutes'] as $field) {
            if ($request->has($field)) {
                $updateData[$field] = $request->$field;
            }
        }

        if (!empty($updateData)) {
            $ride->update($updateData);
        }

        // When the ride is now marked paid (cash or card), credit the driver
        // their earnings. Idempotent — only ever credits once per ride.
        if (($ride->payment_status ?? null) === 'paid') {
            \App\Http\Controllers\Api\WalletController::settleDriverEarnings($ride->fresh());
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment info updated',
            'data' => $ride
        ]);
    }

    /**
     * Driver toggles online/offline status.
     */
    public function toggleOnline(Request $request)
    {
        $request->validate([
            'is_online' => 'required|boolean',
        ]);

        $user = auth()->user();

        // Resolve the Driver record whether the logged-in entity is a Driver
        // (driver guard) or a User that has a linked driver row.
        $driver = ($user instanceof \App\Models\Driver)
            ? $user
            : ($user->driver ?? \App\Models\Driver::where('user_id', $user->id)->first());

        if (!$driver) {
            return response()->json(['success' => false, 'message' => 'Only drivers can toggle online status'], 403);
        }

        $driver->update([
            'is_online'            => $request->is_online,
            'last_location_update' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => $request->is_online ? 'You are now online' : 'You are now offline',
            'is_online' => (bool) $request->is_online,
        ]);
    }

    /**
     * Update ride request by setting driver_id and status to accepted.
     * Used as fallback when driver accepts via Firebase.
     */
    public function assignDriver(Request $request, $id)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
        ]);

        // Only admins can manually assign drivers via this fallback endpoint
        if (auth()->user()->role !== 'admin') {
            return response()->json(['success' => false, 'message' => 'Only admins can assign drivers'], 403);
        }

        $rideRequest = RideRequest::findOrFail($id);

        if ($rideRequest->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Ride is no longer pending'], 400);
        }

        $rideRequest->update([
            'driver_id' => $request->driver_id,
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        // Also create/update a ride offer record for this driver
        RideOffer::updateOrCreate(
            [
                'ride_request_id' => $rideRequest->id,
                'driver_id' => $request->driver_id,
            ],
            [
                'status' => 'accepted',
                'offered_at' => now(),
                'responded_at' => now(),
                'priority_order' => 1,
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Driver assigned successfully',
            'data' => $rideRequest
        ]);
    }

    private function updateAcceptanceRate(int $userId, bool $accepted): void
    {
        $driver = \App\Models\Driver::where('user_id', $userId)->first()
            ?? \App\Models\Driver::find($userId);
        if (!$driver) return;

        $driver->increment('total_offers');
        if ($accepted) $driver->increment('accepted_offers');

        $rate = $driver->total_offers > 0
            ? round(($driver->accepted_offers / $driver->total_offers) * 100, 2)
            : 100;
        $driver->update(['acceptance_rate' => $rate]);
    }
}
