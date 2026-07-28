<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CorporateController extends Controller
{
    /**
     * GET /api/corporate/dashboard
     */
    public function dashboard()
    {
        $corporateId = auth()->id();

        $activeRides = RideRequest::where('corporate_id', $corporateId)
            ->whereIn('status', ['pending', 'accepted', 'arriving', 'in_progress'])->count();

        $fleetSize = Vehicle::where('owner_id', $corporateId)->count();

        $unpaidBill = (float) RideRequest::where('corporate_id', $corporateId)
            ->where('status', 'completed')
            ->where('payment_status', '!=', 'paid')
            ->sum('fare');

        return response()->json([
            'success' => true,
            'active_rides' => $activeRides,
            'fleet_size' => $fleetSize,
            'unpaid_bill' => $unpaidBill,
        ]);
    }

    /**
     * POST /api/corporate/ride-request — book a ride on behalf of an employee.
     */
    public function createRideRequest(Request $request)
    {
        $request->validate([
            'employee_id'     => 'nullable|exists:corporate_employees,id',
            'employee_name'   => 'required_without:employee_id|string|max:255',
            'employee_mobile' => 'required_without:employee_id|string|max:20',
            'ride_type'       => 'required|string',
            'pickup_latitude'         => 'required|numeric',
            'pickup_longitude'        => 'required|numeric',
            'pickup_address'          => 'required|string',
            'destination_latitude'    => 'required|numeric',
            'destination_longitude'   => 'required|numeric',
            'destination_address'     => 'required|string',
        ]);

        $corporateId = auth()->id();

        // Booking for a saved employee fills the name/mobile from the record.
        $name   = $request->employee_name;
        $mobile = $request->employee_mobile;
        if ($request->filled('employee_id')) {
            $emp = \App\Models\CorporateEmployee::where('id', $request->employee_id)
                ->where('corporate_id', $corporateId)->first();
            if (!$emp) {
                return response()->json([
                    'success' => false, 'message' => 'Employee not found for this company.',
                ], 404);
            }
            $name   = $emp->name;
            $mobile = $emp->mobile;
        }

        // Fare is calculated HERE from the admin's per-km rate, never taken
        // from the app — otherwise a tampered request could book at any price.
        $fare = $this->estimateFare(
            (float) $request->pickup_latitude,
            (float) $request->pickup_longitude,
            (float) $request->destination_latitude,
            (float) $request->destination_longitude,
            (string) $request->ride_type
        );

        $ride = RideRequest::create([
            // user_id stays NULL: this trip belongs to the company, not to a
            // rider account. `users` and `corporates` are separate tables with
            // separate id spaces, so putting the corporate id here would
            // attribute the trip to an unrelated rider.
            'user_id'              => null,
            'corporate_id'         => $corporateId,
            'booked_for_name'      => $name,
            'booked_for_mobile'    => $mobile,
            'ride_type'            => $request->ride_type,
            'pickup_latitude'      => $request->pickup_latitude,
            'pickup_longitude'     => $request->pickup_longitude,
            'pickup_address'       => $request->pickup_address,
            'destination_latitude' => $request->destination_latitude,
            'destination_longitude'=> $request->destination_longitude,
            'destination_address'  => $request->destination_address,
            'fare'                 => $fare,
            'status'               => 'pending',
        ]);

        return response()->json(['success' => true, 'ride_request' => $ride], 201);
    }

    /**
     * Straight-line distance × the admin's per-km rate, with the same ride-type
     * multipliers the rider app uses. Keeps corporate pricing consistent with
     * normal bookings.
     */
    private function estimateFare(float $lat1, float $lng1, float $lat2, float $lng2, string $rideType): float
    {
        $earthKm = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) ** 2
            + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;
        $km = $earthKm * 2 * atan2(sqrt($a), sqrt(1 - $a));

        $wp = \App\Models\WebsiteParameter::first();
        $perKm = (float) ($wp->per_km_rate ?? 20);
        // website_parameters has no base_fare column today; read it from
        // app_settings so an admin can introduce one without a schema change.
        $base = (float) \App\Models\AppSetting::getValue('base_fare', 0);

        $multiplier = match ($rideType) {
            'bike'     => 0.6,
            'cng'      => 0.8,
            'premium'  => 1.6,
            'rent_car' => 1.5,
            default    => 1.0, // car
        };

        return round(($base + ($km * $perKm)) * $multiplier, 2);
    }

    /**
     * GET /api/corporate/billing?month=YYYY-MM
     */
    public function billing(Request $request)
    {
        $corporateId = auth()->id();
        $month = $request->get('month', now()->format('Y-m'));
        $start = Carbon::parse($month . '-01')->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $rides = RideRequest::where('corporate_id', $corporateId)
            ->whereBetween('created_at', [$start, $end])
            ->orderByDesc('created_at')
            ->get(['id', 'booked_for_name', 'booked_for_mobile', 'ride_type', 'pickup_address',
                   'destination_address', 'fare', 'status', 'payment_status', 'created_at']);

        return response()->json([
            'success' => true,
            'month' => $month,
            'total_rides' => $rides->count(),
            'total_amount' => (float) $rides->sum('fare'),
            'paid_amount' => (float) $rides->where('payment_status', 'paid')->sum('fare'),
            'unpaid_amount' => (float) $rides->where('payment_status', '!=', 'paid')->sum('fare'),
            'rides' => $rides,
        ]);
    }

    /**
     * GET /api/corporate/billing/{month}/pdf — monthly invoice download.
     */
    public function billingPdf(string $month)
    {
        $corporateId = auth()->id();
        $corporate = auth()->user();
        $start = Carbon::parse($month . '-01')->startOfMonth();
        $end = (clone $start)->endOfMonth();

        $rides = RideRequest::where('corporate_id', $corporateId)
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at')
            ->get();

        $totalAmount = (float) $rides->sum('fare');

        $html = view('receipts.corporate-invoice', compact('corporate', 'rides', 'month', 'totalAmount'))->render();
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($html)->setPaper('a4');

        return $pdf->download("goride-invoice-{$month}.pdf");
    }

    // ─────────────────────── Ride history ───────────────────────

    /**
     * GET /api/corporate/rides — every trip booked by this company.
     * Query: status (optional), limit (default 100)
     */
    public function rides(Request $request)
    {
        $query = RideRequest::where('corporate_id', auth()->id())
            ->orderByDesc('created_at');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $rides = $query->take((int) $request->get('limit', 100))->get([
            'id', 'booked_for_name', 'booked_for_mobile', 'ride_type',
            'pickup_address', 'destination_address', 'fare', 'status',
            'payment_status', 'driver_id', 'created_at', 'completed_at',
        ]);

        // Attach the driver's name without an N+1 query.
        $driverNames = \App\Models\Driver::whereIn('id', $rides->pluck('driver_id')->filter()->unique())
            ->pluck('name', 'id');

        $rides->transform(function ($r) use ($driverNames) {
            $r->driver_name = $r->driver_id ? ($driverNames[$r->driver_id] ?? null) : null;
            $r->fare = (float) $r->fare;
            return $r;
        });

        return response()->json([
            'success' => true,
            'total'   => $rides->count(),
            'rides'   => $rides,
        ]);
    }

    // ───────────────────── Employee directory ─────────────────────

    /** GET /api/corporate/employees */
    public function employees()
    {
        $employees = \App\Models\CorporateEmployee::where('corporate_id', auth()->id())
            ->orderBy('name')->get();

        return response()->json(['success' => true, 'employees' => $employees]);
    }

    /** POST /api/corporate/employees — create or update. */
    public function saveEmployee(Request $request)
    {
        $data = $request->validate([
            'id'            => 'nullable|integer',
            'name'          => 'required|string|max:255',
            'mobile'        => 'required|string|max:30',
            'email'         => 'nullable|email|max:255',
            'department'    => 'nullable|string|max:100',
            'employee_code' => 'nullable|string|max:50',
            'is_active'     => 'nullable|boolean',
        ]);

        $corporateId = auth()->id();

        // Scope the lookup to THIS company so an id from another company can't
        // be overwritten.
        $employee = \App\Models\CorporateEmployee::where('corporate_id', $corporateId)
            ->where('id', $data['id'] ?? 0)->first();

        if ($employee) {
            $employee->update($data);
        } else {
            $employee = \App\Models\CorporateEmployee::create(
                $data + ['corporate_id' => $corporateId]
            );
        }

        return response()->json(['success' => true, 'employee' => $employee]);
    }

    /** DELETE /api/corporate/employees/{id} */
    public function deleteEmployee($id)
    {
        $employee = \App\Models\CorporateEmployee::where('corporate_id', auth()->id())
            ->where('id', $id)->first();

        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['success' => true, 'message' => 'Employee removed']);
    }
}
