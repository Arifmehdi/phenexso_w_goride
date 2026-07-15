<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Thin client for the ShurjoPay checkout API (bKash / Nagad / Rocket / cards).
 * Docs: https://docs.shurjopayment.com
 */
class ShurjoPayService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('shurjopay.base_url'), '/');
    }

    /** Get (and cache for ~50 min) an auth token from ShurjoPay. */
    private function getToken(): ?array
    {
        return Cache::remember('shurjopay_token', 3000, function () {
            try {
                $res = Http::post("{$this->baseUrl}/api/get_token", [
                    'username' => config('shurjopay.username'),
                    'password' => config('shurjopay.password'),
                ]);
                if ($res->successful()) {
                    return [
                        'token'    => $res->json('token'),
                        'store_id' => $res->json('store_id'),
                    ];
                }
                Log::error('ShurjoPay token error: ' . $res->body());
            } catch (\Exception $e) {
                Log::error('ShurjoPay token exception: ' . $e->getMessage());
            }
            return null;
        });
    }

    /**
     * Start a checkout session for a ride payment.
     * Returns the hosted checkout URL, or null on failure.
     */
    public function initiate(array $data): ?array
    {
        $auth = $this->getToken();
        if (!$auth) return null;

        $orderId = config('shurjopay.prefix') . '-' . $data['ride_id'] . '-' . time();

        try {
            $res = Http::withToken($auth['token'])->post("{$this->baseUrl}/api/secret-pay", [
                'token'                => $auth['token'],
                'store_id'             => $auth['store_id'],
                'prefix'               => config('shurjopay.prefix'),
                'order_id'             => $orderId,
                'currency'             => 'BDT',
                'amount'               => $data['amount'],
                'customer_name'        => $data['name'] ?? 'GoRide Customer',
                'customer_phone'       => $data['phone'] ?? '',
                'customer_email'       => $data['email'] ?? 'customer@goride.app',
                'customer_address'     => $data['address'] ?? 'Dhaka',
                'customer_city'        => 'Dhaka',
                'customer_post_code'   => '1200',
                'client_ip'            => request()->ip(),
                'return_url'           => url(config('shurjopay.return_url')),
                'cancel_url'           => url(config('shurjopay.cancel_url')),
            ]);

            if ($res->successful() && $res->json('checkout_url')) {
                return [
                    'checkout_url' => $res->json('checkout_url'),
                    'order_id'     => $orderId,
                    'sp_order_id'  => $res->json('sp_order_id'),
                ];
            }
            Log::error('ShurjoPay initiate error: ' . $res->body());
        } catch (\Exception $e) {
            Log::error('ShurjoPay initiate exception: ' . $e->getMessage());
        }
        return null;
    }

    /** Verify final payment status for an order (call after return/callback). */
    public function verify(string $orderId): ?array
    {
        $auth = $this->getToken();
        if (!$auth) return null;

        try {
            $res = Http::withToken($auth['token'])
                ->post("{$this->baseUrl}/api/verification", ['order_id' => $orderId]);
            if ($res->successful()) {
                return $res->json();
            }
            Log::error('ShurjoPay verify error: ' . $res->body());
        } catch (\Exception $e) {
            Log::error('ShurjoPay verify exception: ' . $e->getMessage());
        }
        return null;
    }
}
