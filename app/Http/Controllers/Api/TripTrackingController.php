<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Models\TripTrackingToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TripTrackingController extends Controller
{
    // Authenticated: generate a shareable tracking token
    public function generateToken(Request $request, $rideId)
    {
        $ride = RideRequest::findOrFail($rideId);
        $user = auth()->user();

        // Only the rider of this trip can generate a token
        if ($ride->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Reuse existing valid token or create new
        $existing = TripTrackingToken::where('ride_request_id', $rideId)
            ->where('expires_at', '>', now())
            ->first();

        if ($existing) {
            return response()->json([
                'success'      => true,
                'tracking_url' => url("/track/{$existing->token}"),
                'expires_at'   => $existing->expires_at,
            ]);
        }

        $token = Str::random(32);
        TripTrackingToken::create([
            'ride_request_id' => $rideId,
            'token'           => $token,
            'expires_at'      => now()->addHours(24),
        ]);

        return response()->json([
            'success'      => true,
            'tracking_url' => url("/track/{$token}"),
            'expires_at'   => now()->addHours(24),
        ]);
    }

    // Public: fetch ride info for tracking page (no auth)
    public function publicTrack(string $token)
    {
        $record = TripTrackingToken::where('token', $token)
            ->where('expires_at', '>', now())
            ->first();

        if (!$record) {
            return response()->json(['error' => 'Invalid or expired tracking link'], 404);
        }

        $ride = RideRequest::with(['user:id,name', 'driver:id,name,average_rating'])
            ->find($record->ride_request_id);

        if (!$ride) {
            return response()->json(['error' => 'Ride not found'], 404);
        }

        return response()->json([
            'success' => true,
            'ride' => [
                'status'              => $ride->status,
                'pickup_address'      => $ride->pickup_address,
                'destination_address' => $ride->destination_address,
                'rider_name'          => $ride->user?->name,
                'driver_name'         => $ride->driver?->name,
                'driver_rating'       => $ride->driver?->average_rating,
                'fare'                => $ride->fare,
                // Driver live location comes from Firestore on the client side
                'firebase_trip_id'    => $ride->firebase_trip_id,
            ],
        ]);
    }
}
