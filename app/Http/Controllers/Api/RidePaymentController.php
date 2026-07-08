<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RideRequest;
use App\Services\ShurjoPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RidePaymentController extends Controller
{
    /**
     * POST /api/payment/shurjopay/initiate
     * body: { ride_id, amount }
     */
    public function shurjopayInitiate(Request $request, ShurjoPayService $shurjopay)
    {
        $request->validate([
            'ride_id' => 'required|integer|exists:ride_requests,id',
            'amount'  => 'required|numeric|min:1',
        ]);

        $ride = RideRequest::findOrFail($request->ride_id);
        if ($ride->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $user = auth()->user();
        $result = $shurjopay->initiate([
            'ride_id' => $ride->id,
            'amount'  => $request->amount,
            'name'    => $user->name,
            'phone'   => $user->mobile,
            'email'   => $user->email,
        ]);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Could not start payment. Try again.'], 502);
        }

        $ride->update([
            'payment_method' => 'shurjopay',
            'payment_status' => 'pending',
            'notes' => trim(($ride->notes ?? '') . " | shurjopay_order:{$result['order_id']}"),
        ]);

        return response()->json([
            'success'      => true,
            'checkout_url' => $result['checkout_url'],
            'order_id'     => $result['order_id'],
        ]);
    }

    /**
     * POST /api/payment/shurjopay/callback — ShurjoPay redirects/pings here
     * with the order_id once the customer finishes on their checkout page.
     */
    public function shurjopayCallback(Request $request, ShurjoPayService $shurjopay)
    {
        $orderId = $request->input('order_id') ?? $request->input('sp_order_id');
        if (!$orderId) {
            return response()->json(['success' => false, 'message' => 'Missing order_id'], 422);
        }

        // order_id format: {prefix}-{ride_id}-{timestamp}
        $parts = explode('-', $orderId);
        $rideId = $parts[1] ?? null;
        $ride = $rideId ? RideRequest::find($rideId) : null;
        if (!$ride) {
            return response()->json(['success' => false, 'message' => 'Ride not found'], 404);
        }

        $verification = $shurjopay->verify($orderId);
        $status = strtolower($verification[0]['sp_code'] ?? $verification['sp_code'] ?? '');
        $isPaid = in_array($status, ['1000', 'success', 'complete']) ||
                  strtolower($verification[0]['bank_status'] ?? '') === 'success';

        $ride->update([
            'payment_status' => $isPaid ? 'paid' : 'failed',
        ]);

        if ($isPaid) {
            $rider = \App\Models\User::find($ride->user_id);
            if ($rider) {
                (new \App\Services\FcmService())->notifyUser($rider, '✅ Payment Confirmed',
                    "Your ride payment of ৳{$ride->fare} was successful.", ['type' => 'payment', 'ride_id' => (string) $ride->id]);
            }
        }

        return response()->json(['success' => true, 'payment_status' => $ride->payment_status]);
    }

    /**
     * POST /payment/sslcommerz/ipn — SSLCommerz server-to-server webhook for rides.
     * Verifies val_id against SSLCommerz before trusting the payment.
     */
    public function sslcommerzIpn(Request $request)
    {
        $tranId = $request->input('tran_id');
        $valId  = $request->input('val_id');
        $status = $request->input('status');

        if (!$tranId || !$valId) {
            return response()->json(['success' => false, 'message' => 'Missing transaction data'], 422);
        }

        // tran_id format written by sslcommerz_service.dart: RIDE_{timestamp} — we also
        // stash the ride id in notes when initiating, but simplest is to look it up
        // by matching the stored transaction reference.
        $ride = RideRequest::where('notes', 'like', "%{$tranId}%")->first();
        if (!$ride) {
            Log::warning("SSLCommerz IPN: no ride found for tran_id={$tranId}");
            return response()->json(['success' => false, 'message' => 'Ride not found'], 404);
        }

        // Verify with SSLCommerz's validation API before trusting the IPN payload.
        $verified = false;
        try {
            $res = Http::get(config('sslcommerz.apiDomain') . config('sslcommerz.apiUrl.order_validate'), [
                'val_id'         => $valId,
                'store_id'       => config('sslcommerz.apiCredentials.store_id'),
                'store_passwd'   => config('sslcommerz.apiCredentials.store_password'),
                'format'         => 'json',
            ]);
            $verified = $res->successful() && in_array($res->json('status'), ['VALID', 'VALIDATED']);
        } catch (\Exception $e) {
            Log::error('SSLCommerz IPN validation exception: ' . $e->getMessage());
        }

        $ride->update([
            'payment_status' => $verified ? 'paid' : 'failed',
            'payment_method' => 'sslcommerz',
        ]);

        if ($verified) {
            $rider = \App\Models\User::find($ride->user_id);
            if ($rider) {
                (new \App\Services\FcmService())->notifyUser($rider, '✅ Payment Confirmed',
                    "Your ride payment of ৳{$ride->fare} was successful.", ['type' => 'payment', 'ride_id' => (string) $ride->id]);
            }
        }

        return response()->json(['success' => true]);
    }
}
