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
            'employee_name'   => 'required|string|max:255',
            'employee_mobile' => 'required|string|max:20',
            'ride_type'       => 'required|string',
            'pickup_latitude'         => 'required|numeric',
            'pickup_longitude'        => 'required|numeric',
            'pickup_address'          => 'required|string',
            'destination_latitude'    => 'required|numeric',
            'destination_longitude'   => 'required|numeric',
            'destination_address'     => 'required|string',
            'fare' => 'required|numeric',
        ]);

        $corporateId = auth()->id();

        $ride = RideRequest::create([
            'user_id'              => $corporateId, // billed against the corporate account
            'corporate_id'         => $corporateId,
            'booked_for_name'      => $request->employee_name,
            'booked_for_mobile'    => $request->employee_mobile,
            'ride_type'            => $request->ride_type,
            'pickup_latitude'      => $request->pickup_latitude,
            'pickup_longitude'     => $request->pickup_longitude,
            'pickup_address'       => $request->pickup_address,
            'destination_latitude' => $request->destination_latitude,
            'destination_longitude'=> $request->destination_longitude,
            'destination_address'  => $request->destination_address,
            'fare'                 => $request->fare,
            'status'               => 'pending',
        ]);

        return response()->json(['success' => true, 'ride_request' => $ride], 201);
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
}
