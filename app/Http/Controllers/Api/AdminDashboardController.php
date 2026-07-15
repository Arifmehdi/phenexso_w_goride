<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\RideRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    /**
     * GET /api/admin/dashboard-stats — top-line KPI cards for the admin home.
     */
    public function dashboardStats()
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();

        $todayRides = RideRequest::whereDate('created_at', $today)->count();
        $todayRevenue = (float) RideRequest::where('status', 'completed')
            ->whereDate('completed_at', $today)->sum('fare');
        $activeDrivers = Driver::where('is_online', true)->count();
        $newUsersToday = User::whereDate('created_at', $today)->count();

        $ridesByStatus = RideRequest::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')->pluck('count', 'status');

        $weeklyRevenue = RideRequest::where('status', 'completed')
            ->where('completed_at', '>=', $weekStart)
            ->selectRaw('DATE(completed_at) as date, SUM(fare) as amount')
            ->groupBy('date')->orderBy('date')
            ->get()
            ->map(fn ($r) => ['date' => $r->date, 'amount' => (float) $r->amount]);

        return response()->json([
            'success' => true,
            'today_rides'      => $todayRides,
            'today_revenue'    => $todayRevenue,
            'active_drivers'   => $activeDrivers,
            'new_users_today'  => $newUsersToday,
            'rides_by_status'  => $ridesByStatus,
            'weekly_revenue'   => $weeklyRevenue,
        ]);
    }

    /**
     * GET /api/admin/active-rides — live ride monitoring feed (map view).
     */
    public function activeRides()
    {
        $rides = RideRequest::with(['user:id,name,mobile', 'driver:id,name,mobile,latitude,longitude,vehicle_type'])
            ->whereIn('status', ['accepted', 'arriving', 'in_progress'])
            ->orderByDesc('accepted_at')
            ->get()
            ->map(fn ($r) => [
                'id'                   => $r->id,
                'status'               => $r->status,
                'ride_type'            => $r->ride_type,
                'fare'                 => (float) $r->fare,
                'pickup_address'       => $r->pickup_address,
                'destination_address'  => $r->destination_address,
                'pickup_latitude'      => (float) $r->pickup_latitude,
                'pickup_longitude'     => (float) $r->pickup_longitude,
                'destination_latitude' => (float) $r->destination_latitude,
                'destination_longitude'=> (float) $r->destination_longitude,
                'accepted_at'          => $r->accepted_at,
                'rider' => $r->user ? ['id' => $r->user->id, 'name' => $r->user->name, 'mobile' => $r->user->mobile] : null,
                'driver' => $r->driver ? [
                    'id' => $r->driver->id, 'name' => $r->driver->name, 'mobile' => $r->driver->mobile,
                    'latitude' => (float) $r->driver->latitude, 'longitude' => (float) $r->driver->longitude,
                    'vehicle_type' => $r->driver->vehicle_type,
                ] : null,
            ]);

        return response()->json(['success' => true, 'active_rides' => $rides]);
    }

    /**
     * GET /api/admin/reports/revenue?from=&to=&group_by=day|week|month
     */
    public function revenueReport(Request $request)
    {
        [$from, $to] = $this->resolveRange($request);
        $groupBy = $request->get('group_by', 'day');
        $dateFormat = match ($groupBy) {
            'week'  => '%x-W%v',
            'month' => '%Y-%m',
            default => '%Y-%m-%d',
        };

        $rows = RideRequest::where('status', 'completed')
            ->whereBetween('completed_at', [$from, $to])
            ->selectRaw("DATE_FORMAT(completed_at, '$dateFormat') as period, SUM(fare) as revenue, COUNT(*) as trips")
            ->groupBy('period')->orderBy('period')
            ->get()
            ->map(fn ($r) => ['period' => $r->period, 'revenue' => (float) $r->revenue, 'trips' => (int) $r->trips]);

        return response()->json([
            'success' => true,
            'from' => $from->toDateString(), 'to' => $to->toDateString(),
            'total_revenue' => (float) $rows->sum('revenue'),
            'rows' => $rows,
        ]);
    }

    /**
     * GET /api/admin/reports/rides?from=&to=&ride_type=&status=
     */
    public function ridesReport(Request $request)
    {
        [$from, $to] = $this->resolveRange($request);

        $query = RideRequest::whereBetween('created_at', [$from, $to]);
        if ($request->filled('ride_type')) $query->where('ride_type', $request->ride_type);
        if ($request->filled('status')) $query->where('status', $request->status);

        $byStatus = (clone $query)->selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status');
        $byType   = (clone $query)->selectRaw('ride_type, COUNT(*) as count')->groupBy('ride_type')->pluck('count', 'ride_type');

        return response()->json([
            'success' => true,
            'from' => $from->toDateString(), 'to' => $to->toDateString(),
            'total_rides' => (clone $query)->count(),
            'by_status' => $byStatus,
            'by_ride_type' => $byType,
        ]);
    }

    /**
     * GET /api/admin/reports/drivers?from=&to=
     */
    public function driversReport(Request $request)
    {
        [$from, $to] = $this->resolveRange($request);

        $rows = RideRequest::where('status', 'completed')
            ->whereBetween('completed_at', [$from, $to])
            ->whereNotNull('driver_id')
            ->selectRaw('driver_id, COUNT(*) as trips, SUM(fare) as earnings, AVG(fare) as avg_fare')
            ->groupBy('driver_id')
            ->orderByDesc('earnings')
            ->get();

        $driverIds = $rows->pluck('driver_id');
        $drivers = Driver::whereIn('id', $driverIds)->get(['id', 'name', 'mobile', 'average_rating', 'acceptance_rate'])->keyBy('id');

        $result = $rows->map(function ($r) use ($drivers) {
            $d = $drivers->get($r->driver_id);
            return [
                'driver_id' => $r->driver_id,
                'name' => $d?->name ?? 'Unknown',
                'mobile' => $d?->mobile,
                'rating' => $d ? (float) $d->average_rating : null,
                'acceptance_rate' => $d ? (float) $d->acceptance_rate : null,
                'trips' => (int) $r->trips,
                'earnings' => (float) $r->earnings,
                'avg_fare' => round((float) $r->avg_fare, 2),
            ];
        });

        return response()->json([
            'success' => true,
            'from' => $from->toDateString(), 'to' => $to->toDateString(),
            'drivers' => $result,
        ]);
    }

    /**
     * POST /api/admin/notifications/broadcast
     * body: { target: all_users|all_drivers|all_corporates|all_admins|everyone, title, message }
     */
    public function broadcastNotification(Request $request, \App\Services\NotificationService $notifications)
    {
        $request->validate([
            'target'  => 'required|in:all_users,all_drivers,all_corporates,all_admins,everyone',
            'title'   => 'required|string|max:255',
            'message' => 'nullable|string|max:1000',
        ]);

        $notification = $notifications->send($request->target, $request->title, $request->message, 'announcement');

        return response()->json(['success' => true, 'notification' => $notification]);
    }

    private function resolveRange(Request $request): array
    {
        $from = $request->filled('from') ? Carbon::parse($request->from)->startOfDay() : Carbon::now()->subDays(30)->startOfDay();
        $to = $request->filled('to') ? Carbon::parse($request->to)->endOfDay() : Carbon::now()->endOfDay();
        return [$from, $to];
    }
}
