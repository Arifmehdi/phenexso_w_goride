<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use Illuminate\Support\Carbon;

class DriverStatsController extends Controller
{
    public function stats()
    {
        $user   = auth()->user();
        $today  = Carbon::today();
        $driver = $user->driver;

        $todayTrips = RideRequest::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', $today)->count();

        $todayEarnings = RideRequest::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', $today)->sum('fare');

        $todayCancelled = RideRequest::where('driver_id', $user->id)
            ->where('status', 'cancelled')
            ->whereDate('updated_at', $today)->count();

        $avgRating = $driver?->average_rating ?? 0;
        $acceptanceRate = $driver?->acceptance_rate ?? 100;

        return response()->json([
            'success' => true,
            'stats'   => [
                'today_trips'      => $todayTrips,
                'today_earnings'   => (float) $todayEarnings,
                'today_cancelled'  => $todayCancelled,
                'avg_rating'       => round((float) $avgRating, 1),
                'acceptance_rate'  => round((float) $acceptanceRate, 0),
                'is_online'        => (bool) ($driver?->is_online ?? false),
            ],
        ]);
    }
}
