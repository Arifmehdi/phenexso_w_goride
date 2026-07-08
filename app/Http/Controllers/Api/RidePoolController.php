<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RidePool;
use Illuminate\Http\Request;

class RidePoolController extends Controller
{
    /**
     * GET /api/ride-requests/pool/available
     * ?pickup_lat=&pickup_lng=&dest_lat=&dest_lng=
     *
     * Finds open, non-full pools whose pickup is nearby (within 1.5km)
     * AND whose direction of travel roughly matches the requester's trip.
     */
    public function available(Request $request)
    {
        $request->validate([
            'pickup_lat' => 'required|numeric',
            'pickup_lng' => 'required|numeric',
            'dest_lat'   => 'required|numeric',
            'dest_lng'   => 'required|numeric',
        ]);

        $pLat = (float) $request->pickup_lat;
        $pLng = (float) $request->pickup_lng;
        $dLat = (float) $request->dest_lat;
        $dLng = (float) $request->dest_lng;
        $myBearing = $this->bearing($pLat, $pLng, $dLat, $dLng);

        $pools = RidePool::with(['rideRequest.driver:id,name,average_rating', 'passengers'])
            ->where('is_open', true)
            ->whereColumn('current_passengers', '<', 'max_passengers')
            ->whereHas('rideRequest', fn ($q) => $q->whereIn('status', ['accepted', 'arriving']))
            ->get()
            ->filter(function (RidePool $pool) use ($pLat, $pLng, $myBearing) {
                $ride = $pool->rideRequest;
                if (!$ride) return false;

                $distance = $this->haversine($pLat, $pLng, (float) $ride->pickup_latitude, (float) $ride->pickup_longitude);
                if ($distance > 1.5) return false; // must be within 1.5km of the pool's pickup

                $poolBearing = $this->bearing(
                    (float) $ride->pickup_latitude, (float) $ride->pickup_longitude,
                    (float) $ride->destination_latitude, (float) $ride->destination_longitude
                );
                $angleDiff = abs($myBearing - $poolBearing);
                $angleDiff = min($angleDiff, 360 - $angleDiff);

                return $angleDiff <= 30; // roughly the same direction
            })
            ->map(function (RidePool $pool) use ($pLat, $pLng) {
                $ride = $pool->rideRequest;
                $distance = $this->haversine($pLat, $pLng, (float) $ride->pickup_latitude, (float) $ride->pickup_longitude);
                return [
                    'pool_id'         => $pool->id,
                    'ride_request_id' => $ride->id,
                    'seats_left'      => $pool->max_passengers - $pool->current_passengers,
                    'distance_km'     => round($distance, 2),
                    'pickup_address'  => $ride->pickup_address,
                    'destination_address' => $ride->destination_address,
                    'fare'            => (float) $ride->fare,
                    'driver'          => $ride->driver ? [
                        'name' => $ride->driver->name,
                        'rating' => (float) $ride->driver->average_rating,
                    ] : null,
                ];
            })
            ->values();

        return response()->json(['success' => true, 'pools' => $pools]);
    }

    private function haversine(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) ** 2 + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;
        return $earthRadius * 2 * atan2(sqrt($a), sqrt(1 - $a));
    }

    /** Compass bearing in degrees (0-360) from point 1 to point 2. */
    private function bearing(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $lat1Rad = deg2rad($lat1);
        $lat2Rad = deg2rad($lat2);
        $dLng = deg2rad($lng2 - $lng1);
        $y = sin($dLng) * cos($lat2Rad);
        $x = cos($lat1Rad) * sin($lat2Rad) - sin($lat1Rad) * cos($lat2Rad) * cos($dLng);
        return fmod((rad2deg(atan2($y, $x)) + 360), 360);
    }
}
