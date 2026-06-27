<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EarningsController extends Controller
{
    public function index(Request $request)
    {
        $user   = auth()->user();
        $period = $request->get('period', 'today');

        $query = RideRequest::where('driver_id', $user->id)
            ->where('status', 'completed');

        $start = match ($period) {
            'today'  => Carbon::today(),
            'week'   => Carbon::now()->startOfWeek(),
            'month'  => Carbon::now()->startOfMonth(),
            default  => Carbon::today(),
        };

        $periodData = (clone $query)->where('completed_at', '>=', $start);

        // Daily breakdown (last 14 days for chart)
        $daily = RideRequest::where('driver_id', $user->id)
            ->where('status', 'completed')
            ->where('completed_at', '>=', Carbon::now()->subDays(14))
            ->selectRaw('DATE(completed_at) as date, SUM(fare) as total, COUNT(*) as trips')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'success' => true,
            'period'  => $period,
            'summary' => [
                'total_earnings' => $periodData->sum('fare'),
                'total_trips'    => $periodData->count(),
                'avg_fare'       => round($periodData->avg('fare') ?? 0, 2),
                'all_time_trips' => $query->count(),
            ],
            'daily_chart' => $daily,
        ]);
    }

    public function receiptPdf($rideId)
    {
        $ride = RideRequest::with(['user', 'driver'])->findOrFail($rideId);
        $user = auth()->user();

        // Only rider or driver of this trip can view receipt
        if ($ride->user_id !== $user->id && $ride->driver_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $html = view('receipts.ride', compact('ride'))->render();
        $pdf  = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)->setPaper('a5');

        return $pdf->download("goride-receipt-{$rideId}.pdf");
    }
}
