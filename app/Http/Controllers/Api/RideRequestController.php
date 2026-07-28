<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RideRequestController extends Controller
{
    /**
     * Create a new ride request.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ride_type' => 'required|string',
            'pickup_latitude' => 'required|numeric',
            'pickup_longitude' => 'required|numeric',
            'pickup_address' => 'required|string',
            'destination_latitude' => 'required|numeric',
            'destination_longitude' => 'required|numeric',
            'destination_address' => 'required|string',
            'fare' => 'required|numeric',
            'firebase_trip_id' => 'nullable|string',
        ]);

        $rideRequest = RideRequest::create([
            'user_id' => auth()->id(),
            'ride_type' => $request->ride_type,
            'pickup_latitude' => $request->pickup_latitude,
            'pickup_longitude' => $request->pickup_longitude,
            'pickup_address' => $request->pickup_address,
            'destination_latitude' => $request->destination_latitude,
            'destination_longitude' => $request->destination_longitude,
            'destination_address' => $request->destination_address,
            'fare' => $request->fare,
            'status' => 'pending',
            'firebase_trip_id' => $request->firebase_trip_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Ride request created successfully',
            'data' => $rideRequest
        ], 201);
    }

    /**
     * Update ride request status (accept, start, complete, cancel).
     */
    public function updateStatus(Request $request, $id)
    {
        $rideRequest = RideRequest::findOrFail($id);
        $previousStatus = $rideRequest->status;
        $status = $request->status;
        $user = auth()->user();
        $fcm = new \App\Services\FcmService();

        $rider  = \App\Models\User::find($rideRequest->user_id);
        $driver = \App\Models\Driver::find($rideRequest->driver_id);

        if ($status == 'accepted') {
            $driverId = ($user instanceof \App\Models\Driver)
                ? $user->id
                : (($user->driver->id ?? null) ?: $user->id);
            $rideRequest->update(['driver_id' => $driverId, 'status' => 'accepted', 'accepted_at' => now()]);
            if ($rider) $fcm->rideAccepted($rider, $user->name ?? 'Driver');

            // Tell all OTHER offered drivers the ride is gone — cancels their
            // ringing notification in real time (first-to-accept wins).
            $otherDriverIds = \App\Models\RideOffer::where('ride_request_id', $rideRequest->id)
                ->where('driver_id', '!=', $driverId)
                ->whereIn('status', ['pending'])
                ->pluck('driver_id');

            \App\Models\RideOffer::where('ride_request_id', $rideRequest->id)
                ->where('driver_id', '!=', $driverId)
                ->where('status', 'pending')
                ->update(['status' => 'expired', 'responded_at' => now()]);

            foreach (\App\Models\Driver::whereIn('id', $otherDriverIds)->whereNotNull('fcm_token')->get() as $other) {
                $fcm->sendData($other->fcm_token, [
                    'type'       => 'ride_taken',
                    'request_id' => (string) $rideRequest->id,
                ]);
            }

        } elseif ($status == 'arriving') {
            $rideRequest->update(['status' => 'arriving']);
            if ($rider) {
                // Stores an in-app Notification row AND sends the FCM push
                // (unlike FcmService::driverArrived(), which is push-only and
                // silently does nothing if no FCM token/credentials exist).
                app(\App\Services\NotificationService::class)->toUser(
                    $rider, '📍 Driver Arrived',
                    'Your driver has arrived at the pickup location.',
                    'driver_arrived'
                );
            }

        } elseif ($status == 'in_progress') {
            $rideRequest->update(['status' => 'in_progress', 'started_at' => now()]);
            if ($rider) $fcm->tripStarted($rider);

        } elseif ($status == 'completed') {
            $rideRequest->update(['status' => 'completed', 'completed_at' => now()]);
            if ($rider) $fcm->tripCompleted($rider, (string) $rideRequest->fare);

            // Referral bonus: when a referred rider completes their FIRST ride,
            // BOTH sides get paid (once only) — the referrer gets the referral
            // bonus, the new rider gets the welcome bonus. Amounts are set by
            // the admin; 0 disables that side.
            if ($rider && $rider->referred_by && !$rider->referral_credited) {
                $isFirstRide = \App\Models\RideRequest::where('user_id', $rider->id)
                    ->where('status', 'completed')
                    ->where('id', '!=', $rideRequest->id)
                    ->doesntExist();
                if ($isFirstRide) {
                    $refCtrl = \App\Http\Controllers\Api\ReferralController::class;
                    $bonus   = $refCtrl::referralBonus();
                    $welcome = $refCtrl::refereeBonus();
                    // Referrer may be a rider OR a driver — credit the right wallet.
                    $refType = $rider->referred_by_type ?: 'user';

                    if ($bonus > 0) {
                        \App\Http\Controllers\Api\WalletController::creditWallet(
                            $rider->referred_by, $refType, $bonus,
                            "Referral bonus — {$rider->name} completed their first ride",
                            "referral_{$rider->id}"
                        );
                    }
                    if ($welcome > 0) {
                        \App\Http\Controllers\Api\WalletController::creditWallet(
                            $rider->id, 'user', $welcome,
                            'Welcome bonus — thanks for joining with a referral code',
                            "referral_welcome_{$rider->id}"
                        );
                    }
                    $rider->update(['referral_credited' => true]);
                }
            }

        } elseif ($status == 'cancelled') {
            $cancelledBy = ($user->role === 'driver') ? 'driver' : 'rider';
            $rideRequest->update([
                'status' => 'cancelled',
                'cancelled_by' => $request->cancelled_by ?? $cancelledBy,
                'cancellation_reason' => $request->cancellation_reason ?? 'Cancelled by ' . $cancelledBy,
            ]);

            // A driver had already been assigned and was on the way (or the
            // trip was running) — this is the "chargeable" window on both sides.
            $wasChargeable = in_array($previousStatus, ['accepted', 'arriving', 'in_progress']);
            $cancelFee = 50.0;

            if ($wasChargeable && $cancelledBy === 'rider' && $rider) {
                // Fixed cancellation fee — charged to the rider (balance may go
                // negative; settled on their next top-up, same as other apps)
                // and paid to the driver as compensation for the wasted trip.
                $riderWallet = \App\Models\Wallet::firstOrCreate(
                    ['user_id' => $rider->id, 'owner_type' => 'user'],
                    ['balance' => 0]
                );
                $riderWallet->decrement('balance', $cancelFee);
                \App\Models\WalletTransaction::create([
                    'user_id'       => $rider->id,
                    'owner_type'    => 'user',
                    'type'          => 'debit',
                    'amount'        => $cancelFee,
                    'description'   => "Cancellation fee — ride #{$rideRequest->id}",
                    'reference'     => "cancel_fee_{$rideRequest->id}",
                    'balance_after' => $riderWallet->fresh()->balance,
                ]);
                if ($driver) {
                    \App\Http\Controllers\Api\WalletController::creditWallet(
                        $driver->id, 'driver', $cancelFee,
                        "Cancellation compensation — ride #{$rideRequest->id}",
                        "cancel_comp_{$rideRequest->id}"
                    );
                }
            } elseif ($wasChargeable && $cancelledBy === 'driver' && $driver) {
                // No cash fee for the driver — instead, a reliability strike:
                // a running cancellation count (visible on their profile) and
                // a hit to acceptance_rate, the same score shown in the admin
                // driver report and the driver's own stats screen.
                $driver->increment('cancelled_rides_count');
                $driver->update([
                    'acceptance_rate' => max(0, (float) $driver->acceptance_rate - 5),
                ]);
            }

            // Notify the other party. notify() stores the in-app notification
            // AND pushes, so a cancellation still shows in their list (and the
            // bell badge) even if the push is missed or there's no token.
            if ($cancelledBy === 'rider' && $driver) {
                notify()->toDriver($driver, 'Ride Cancelled',
                    'The rider has cancelled this trip.', 'ride_cancelled');
            } elseif ($cancelledBy === 'driver' && $rider) {
                notify()->toUser($rider, 'Ride Cancelled',
                    'Your driver has cancelled. We are finding another driver.', 'ride_cancelled');
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Ride status updated to ' . $status,
            'data' => $rideRequest
        ]);
    }

    /**
     * Update user/driver live location.
     */
    public function updateLocation(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = auth()->user();

        $coords = [
            'latitude'             => $request->latitude,
            'longitude'            => $request->longitude,
            'last_location_update' => now(),
        ];

        // Always update the authenticated entity (User OR Driver row).
        $user->update($coords);

        // If a User has a linked driver row, keep that in sync too.
        if (!($user instanceof \App\Models\Driver) && ($user->driver ?? null)) {
            $user->driver->update($coords);
        }

        return response()->json([
            'success' => true,
            'message' => 'Location updated successfully'
        ]);
    }

    /**
     * Get nearby drivers within a radius (default 5km).
     */
    public function nearbyDrivers(Request $request)
    {
        $lat = $request->latitude;
        $lng = $request->longitude;
        $radius = $request->radius ?? 5; // km

        // Search in Drivers table
        $drivers = Driver::select('id', 'name', 'latitude', 'longitude', 'mobile')
            ->selectRaw(
                '( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
                [$lat, $lng, $lat]
            )
            ->where('status', 1) // Active
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $drivers
        ]);
    }

    /**
     * Get active ride for the user.
     */
    public function activeRide()
    {
        $user = auth()->user();
        $query = RideRequest::with('driver', 'user')
            ->whereIn('status', ['pending', 'accepted', 'arriving', 'in_progress']);
        
        if ($user->role == 'driver') {
            $driverId = isset($user->driver) ? $user->driver->id : $user->id;
            $ride = $query->where('driver_id', $driverId)->first();
        } else {
            $ride = $query->where('user_id', $user->id)->first();
        }

        return response()->json([
            'success' => true,
            'data' => $ride
        ]);
    }
}
