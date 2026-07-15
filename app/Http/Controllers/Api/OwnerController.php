<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Models\Vehicle;
use App\Models\VehicleAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OwnerController extends Controller
{
    /** Driver ids currently assigned to this owner's vehicles. */
    private function fleetDriverIds(int $ownerId): array
    {
        $vehicleIds = Vehicle::where('owner_id', $ownerId)->pluck('id');
        return VehicleAssignment::whereIn('vehicle_id', $vehicleIds)
            ->whereNotNull('driver_id')
            ->pluck('driver_id')->unique()->values()->all();
    }

    /**
     * GET /api/owner/dashboard
     */
    public function dashboard(Request $request)
    {
        $ownerId = auth()->id();
        $today = Carbon::today();

        $totalCars = Vehicle::where('owner_id', $ownerId)->count();
        $activeCars = Vehicle::where('owner_id', $ownerId)->where('status', 1)->count();
        $driverIds = $this->fleetDriverIds($ownerId);

        $todayTrips = RideRequest::whereIn('driver_id', $driverIds)
            ->where('status', 'completed')->whereDate('completed_at', $today)->count();

        $monthEarnings = (float) RideRequest::whereIn('driver_id', $driverIds)
            ->where('status', 'completed')
            ->where('completed_at', '>=', Carbon::now()->startOfMonth())
            ->sum('fare');

        return response()->json([
            'success' => true,
            'total_cars'      => $totalCars,
            'active_cars'     => $activeCars,
            'total_riders'    => count($driverIds),
            'today_trips'     => $todayTrips,
            'month_earnings'  => $monthEarnings,
        ]);
    }

    /**
     * GET /api/owner/fleet — vehicles + their assigned driver & today's trip count.
     */
    public function fleet()
    {
        $ownerId = auth()->id();
        $today = Carbon::today();

        $vehicles = Vehicle::where('owner_id', $ownerId)->get()->map(function ($v) use ($today) {
            $assignment = VehicleAssignment::where('vehicle_id', $v->id)->latest()->first();
            $driver = $assignment?->driver;
            $todayTrips = $driver
                ? RideRequest::where('driver_id', $driver->id)->where('status', 'completed')->whereDate('completed_at', $today)->count()
                : 0;

            return [
                'id' => $v->id,
                'vehicle_type' => $v->vehicle_type,
                'plate_number' => $v->plate_number,
                'status' => $v->status == 1 ? 'active' : 'inactive',
                'driver' => $driver ? ['id' => $driver->id, 'name' => $driver->name, 'mobile' => $driver->mobile] : null,
                'today_trips' => $todayTrips,
            ];
        });

        return response()->json(['success' => true, 'fleet' => $vehicles]);
    }

    /**
     * GET /api/owner/earnings?period=today|week|month
     */
    public function earnings(Request $request)
    {
        $ownerId = auth()->id();
        $period = $request->get('period', 'month');
        $driverIds = $this->fleetDriverIds($ownerId);

        $start = match ($period) {
            'today' => Carbon::today(),
            'week'  => Carbon::now()->startOfWeek(),
            default => Carbon::now()->startOfMonth(),
        };

        $query = RideRequest::whereIn('driver_id', $driverIds)
            ->where('status', 'completed')->where('completed_at', '>=', $start);

        $perVehicle = RideRequest::whereIn('driver_id', $driverIds)
            ->where('status', 'completed')->where('completed_at', '>=', $start)
            ->selectRaw('driver_id, SUM(fare) as earnings, COUNT(*) as trips')
            ->groupBy('driver_id')->get()
            ->map(fn ($r) => [
                'driver_id' => $r->driver_id,
                'earnings'  => (float) $r->earnings,
                'trips'     => (int) $r->trips,
            ]);

        return response()->json([
            'success' => true,
            'period' => $period,
            'total_earnings' => (float) $query->sum('fare'),
            'total_trips' => (clone $query)->count(),
            'per_driver' => $perVehicle,
        ]);
    }
}
