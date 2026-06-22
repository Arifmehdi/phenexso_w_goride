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

        if ($status == 'accepted') {
            // Check if it's a driver accepting (using your existing relationship if possible)
            // Assuming your User model has a 'driver' relationship to the 'drivers' table
            $driverId = ($user->role == 'driver' && isset($user->driver)) ? $user->driver->id : $user->id;

            $rideRequest->update([
                'driver_id' => $driverId,
                'status' => 'accepted',
                'accepted_at' => now(),
            ]);
        } elseif ($status == 'in_progress') {
            $rideRequest->update([
                'status' => 'in_progress',
                'started_at' => now(),
            ]);
        } elseif ($status == 'completed') {
            $rideRequest->update([
                'status' => 'completed',
                'completed_at' => now(),
            ]);
        } elseif ($status == 'cancelled') {
            $cancelledBy = ($user->role === 'driver') ? 'driver' : 'rider';
            $rideRequest->update([
                'status' => 'cancelled',
                'cancelled_by' => $request->cancelled_by ?? $cancelledBy,
                'cancellation_reason' => $request->cancellation_reason ?? 'Cancelled by ' . $cancelledBy,
            ]);
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
        
        // Update User table
        $user->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'last_location_update' => now(),
        ]);

        // If this user is a driver, also update the Drivers table
        if ($user->role == 'driver' && isset($user->driver)) {
            $user->driver->update([
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'last_location_update' => now(),
            ]);
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
