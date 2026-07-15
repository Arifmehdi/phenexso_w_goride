<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverRating;
use App\Models\RideRequest;
use Illuminate\Http\Request;

class DriverRatingController extends Controller
{
    /**
     * Submit a rating for a driver after a completed trip.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ride_request_id' => 'required|exists:ride_requests,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        $user = auth()->user();

        // Verify the ride request belongs to this user and is completed
        $rideRequest = RideRequest::where('id', $request->ride_request_id)
            ->where('user_id', $user->id)
            ->where('status', 'completed')
            ->first();

        if (!$rideRequest) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid ride request. You can only rate completed rides.',
            ], 400);
        }

        // Check if already rated
        $existing = DriverRating::where('ride_request_id', $request->ride_request_id)->first();
        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this ride.',
            ], 400);
        }

        // Resolve driver_id from ride request if not provided
        $driverId = $request->driver_id ?? $rideRequest->driver_id;
        if (!$driverId) {
            return response()->json([
                'success' => false,
                'message' => 'No driver assigned to this ride.',
            ], 400);
        }

        // Create the rating
        $rating = DriverRating::create([
            'ride_request_id' => $request->ride_request_id,
            'user_id' => $user->id,
            'driver_id' => $driverId,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        // Recalculate driver's average rating
        $driver = Driver::find($driverId);
        if ($driver) {
            $driver->recalculateRating();
        }

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully.',
            'data' => [
                'rating' => $rating,
                'driver' => [
                    'id' => $driver->id,
                    'name' => $driver->name,
                    'average_rating' => $driver->average_rating,
                    'total_ratings' => $driver->total_ratings,
                ],
            ],
        ], 201);
    }

    /**
     * Get ratings for a specific driver.
     */
    public function driverRatings($driverId)
    {
        $driver = Driver::findOrFail($driverId);

        $ratings = DriverRating::with('user:id,name')
            ->where('driver_id', $driverId)
            ->latest()
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => [
                'driver' => [
                    'id' => $driver->id,
                    'name' => $driver->name,
                    'average_rating' => $driver->average_rating,
                    'total_ratings' => $driver->total_ratings,
                ],
                'ratings' => $ratings,
            ],
        ]);
    }

    /**
     * Check if user has already rated a specific ride.
     */
    public function checkRating($rideRequestId)
    {
        $user = auth()->user();

        $rating = DriverRating::where('ride_request_id', $rideRequestId)
            ->where('user_id', $user->id)
            ->first();

        return response()->json([
            'success' => true,
            'rated' => $rating ? true : false,
            'data' => $rating,
        ]);
    }
}
