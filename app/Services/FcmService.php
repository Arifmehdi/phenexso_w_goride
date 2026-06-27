<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmService
{
    private string $serverKey;
    private string $endpoint = 'https://fcm.googleapis.com/fcm/send';

    public function __construct()
    {
        $this->serverKey = config('services.fcm.server_key', '');
    }

    /**
     * Send a push notification to a single FCM token.
     */
    public function send(string $token, string $title, string $body, array $data = []): bool
    {
        if (empty($this->serverKey) || empty($token)) {
            Log::warning('FCM: server key or token missing');
            return false;
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'key=' . $this->serverKey,
                'Content-Type'  => 'application/json',
            ])->post($this->endpoint, [
                'to' => $token,
                'notification' => [
                    'title' => $title,
                    'body'  => $body,
                    'sound' => 'default',
                ],
                'data'     => $data,
                'priority' => 'high',
                'android'  => ['priority' => 'high'],
            ]);

            if ($response->successful()) {
                return true;
            }

            Log::error('FCM send failed: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('FCM exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Notify a user by their stored FCM token.
     */
    /**
     * Notify a User (rider/owner/corporate) — reads fcm_token from users table.
     */
    public function notifyUser(\App\Models\User $user, string $title, string $body, array $data = []): bool
    {
        if (empty($user->fcm_token)) return false;
        return $this->send($user->fcm_token, $title, $body, $data);
    }

    /**
     * Notify a Driver — reads fcm_token from drivers table.
     */
    public function notifyDriver(\App\Models\Driver $driver, string $title, string $body, array $data = []): bool
    {
        if (empty($driver->fcm_token)) return false;
        return $this->send($driver->fcm_token, $title, $body, $data);
    }

    // ── Ride event helpers ──────────────────────────────────

    public function rideAssigned(\App\Models\User $rider, array $rideData): void
    {
        $this->notifyUser($rider, '🚗 Driver Found!',
            "Your driver is on the way. Fare: ৳{$rideData['fare']}",
            array_merge($rideData, ['type' => 'ride_assigned']));
    }

    public function rideAccepted(\App\Models\User $rider, string $driverName): void
    {
        $this->notifyUser($rider, '✅ Driver Accepted',
            "$driverName has accepted your ride and is heading to you.",
            ['type' => 'ride_accepted', 'driver_name' => $driverName]);
    }

    public function driverArrived(\App\Models\User $rider): void
    {
        $this->notifyUser($rider, '📍 Driver Arrived',
            'Your driver has arrived at the pickup location.',
            ['type' => 'driver_arrived']);
    }

    public function tripStarted(\App\Models\User $rider): void
    {
        $this->notifyUser($rider, '🚀 Trip Started',
            'Your trip has started. Have a safe journey!',
            ['type' => 'trip_started']);
    }

    public function tripCompleted(\App\Models\User $rider, string $fare): void
    {
        $this->notifyUser($rider, '🏁 Trip Completed',
            "You have arrived! Total fare: ৳$fare",
            ['type' => 'trip_completed', 'fare' => $fare]);
    }

    /**
     * Notify a driver about a new ride — driver can be a User or a Driver model.
     */
    public function newRideRequest($driverModel, array $rideData): void
    {
        $token = $driverModel->fcm_token ?? '';
        if (empty($token)) return;
        $this->send($token, '🔔 New Ride Request',
            "{$rideData['rider_name']} • {$rideData['pickup']} → {$rideData['destination']} • ৳{$rideData['fare']}",
            array_merge($rideData, ['type' => 'ride_request']));
    }
}
