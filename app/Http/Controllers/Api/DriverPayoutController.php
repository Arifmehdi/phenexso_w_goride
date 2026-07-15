<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverPayout;
use App\Models\RideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DriverPayoutController extends Controller
{
    /**
     * GET /api/admin/payouts/pending
     *
     * For every driver with completed-ride earnings not yet covered by a
     * payout, (re)computes a 'pending' DriverPayout row covering the period
     * since their last payout (or account start) through now.
     */
    public function pending()
    {
        // Admin-editable via System Settings (stored as a PERCENT on
        // website_parameters); .env fraction is the fallback.
        $wpCommission = \App\Models\WebsiteParameter::first()->commission_rate ?? null;
        $commissionRate = $wpCommission !== null
            ? ((float) $wpCommission) / 100
            : (float) config('services.goride.commission_rate', 0.15);

        $driverIds = RideRequest::where('status', 'completed')->whereNotNull('driver_id')
            ->distinct()->pluck('driver_id');

        foreach ($driverIds as $driverId) {
            $lastPayout = DriverPayout::where('driver_id', $driverId)
                ->whereIn('status', ['paid', 'processing'])
                ->orderByDesc('period_to')->first();

            $periodFrom = $lastPayout ? Carbon::parse($lastPayout->period_to)->addDay() : Carbon::createFromTimestamp(0);
            $periodTo = Carbon::now();

            $gross = (float) RideRequest::where('driver_id', $driverId)
                ->where('status', 'completed')
                ->whereBetween('completed_at', [$periodFrom, $periodTo])
                ->sum('fare');

            if ($gross <= 0) continue;

            $commission = round($gross * $commissionRate, 2);
            $net = round($gross - $commission, 2);

            DriverPayout::updateOrCreate(
                ['driver_id' => $driverId, 'status' => 'pending'],
                [
                    'period_from'     => $periodFrom->toDateString(),
                    'period_to'       => $periodTo->toDateString(),
                    'gross_earnings'  => $gross,
                    'commission'      => $commission,
                    'net_amount'      => $net,
                ]
            );
        }

        $payouts = DriverPayout::with('driver:id,name,mobile')
            ->where('status', 'pending')
            ->orderByDesc('net_amount')
            ->get();

        return response()->json([
            'success' => true,
            'total_pending' => (float) $payouts->sum('net_amount'),
            'payouts' => $payouts,
        ]);
    }

    /**
     * POST /api/admin/payouts/process
     * body: { payout_id, payout_method }
     */
    public function process(Request $request)
    {
        $request->validate([
            'payout_id'     => 'required|integer|exists:driver_payouts,id',
            'payout_method' => 'nullable|string|max:50',
        ]);

        $payout = DriverPayout::findOrFail($request->payout_id);
        if ($payout->status === 'paid') {
            return response()->json(['success' => false, 'message' => 'Already paid'], 422);
        }

        $driver = Driver::find($payout->driver_id);
        if (!$driver) {
            return response()->json(['success' => false, 'message' => 'Driver not found'], 404);
        }

        WalletController::creditWallet(
            $driver->id, 'driver', (float) $payout->net_amount,
            "Payout for {$payout->period_from} to {$payout->period_to}",
            "payout_{$payout->id}"
        );

        $payout->update([
            'status'         => 'paid',
            'payout_method'  => $request->payout_method ?? 'wallet',
            'reference'      => 'PYT-' . $payout->id . '-' . now()->format('YmdHis'),
            'paid_at'        => now(),
            'processed_by'   => auth()->id(),
        ]);

        if (!empty($driver->fcm_token)) {
            (new \App\Services\FcmService())->send($driver->fcm_token, '💰 Payout Processed',
                "৳{$payout->net_amount} has been added to your wallet.", ['type' => 'payout']);
        }

        return response()->json(['success' => true, 'payout' => $payout]);
    }

    /**
     * GET /api/admin/payouts/export — CSV download of all payouts (optionally filtered by status).
     */
    public function export(Request $request)
    {
        $query = DriverPayout::with('driver:id,name,mobile')->orderByDesc('created_at');
        if ($request->filled('status')) $query->where('status', $request->status);
        $payouts = $query->get();

        $filename = 'driver-payouts-' . now()->format('Ymd-His') . '.csv';
        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($payouts) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Payout ID', 'Driver', 'Mobile', 'Period From', 'Period To', 'Gross', 'Commission', 'Net', 'Status', 'Method', 'Paid At']);
            foreach ($payouts as $p) {
                fputcsv($handle, [
                    $p->id, $p->driver?->name, $p->driver?->mobile,
                    $p->period_from, $p->period_to,
                    $p->gross_earnings, $p->commission, $p->net_amount,
                    $p->status, $p->payout_method, $p->paid_at,
                ]);
            }
            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }
}
