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
            if ($rider) $fcm->driverArrived($rider);

        } elseif ($status == 'in_progress') {
            $rideRequest->update(['status' => 'in_progress', 'started_at' => now()]);
            if ($rider) $fcm->tripStarted($rider);

        } elseif ($status == 'completed') {
            $rideRequest->update(['status' => 'completed', 'completed_at' => now()]);
            if ($rider) $fcm->tripCompleted($rider, (string) $rideRequest->fare);

        } elseif ($status == 'cancelled') {
            $cancelledBy = ($user->role === 'driver') ? 'driver' : 'rider';
            $rideRequest->update([
                'status' => 'cancelled',
                'cancelled_by' => $request->cancelled_by ?? $cancelledBy,
                'cancellation_reason' => $request->cancellation_reason ?? 'Cancelled by ' . $cancelledBy,
            ]);
            // Notify the other party (driver token from drivers table, rider from users)
            if ($cancelledBy === 'rider' && $driver && !empty($driver->fcm_token)) {
                $fcm->send($driver->fcm_token, 'Ride Cancelled', 'The rider has cancelled this trip.', ['type' => 'ride_cancelled']);
            } elseif ($cancelledBy === 'driver' && $rider && !empty($rider->fcm_token)) {
                $fcm->send($rider->fcm_token, 'Ride Cancelled', 'Your driver has cancelled. We are finding another driver.', ['type' => 'ride_cancelled']);
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
