<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FcmService
{
    private ?array $credentials = null;
    private ?string $projectId = null;

    public function __construct()
    {
        $path = config('services.fcm.credentials');
        if ($path && file_exists($path)) {
            $json = json_decode(file_get_contents($path), true);
            if (is_array($json) && isset($json['private_key'], $json['client_email'], $json['project_id'])) {
                $this->credentials = $json;
                $this->projectId   = $json['project_id'];
            }
        }
    }

    /**
     * Send a push notification to a single FCM token (HTTP v1 API).
     */
    public function send(string $token, string $title, string $body, array $data = []): bool
    {
        if (empty($token)) return false;

        if (!$this->credentials) {
            Log::warning('FCM: service-account JSON not found. Set FIREBASE_CREDENTIALS in .env.');
            return false;
        }

        $accessToken = $this->getAccessToken();
        if (!$accessToken) return false;

        // v1 requires all data values to be strings
        $stringData = [];
        foreach ($data as $k => $v) {
            $stringData[$k] = is_scalar($v) ? (string) $v : json_encode($v);
        }

        try {
            $response = Http::withToken($accessToken)
                ->connectTimeout(3)->timeout(6)
                ->post("https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send", [
                    'message' => [
                        'token' => $token,
                        'notification' => [
                            'title' => $title,
                            'body'  => $body,
                        ],
                        'data'    => $stringData ?: null,
                        'android' => [
                            'priority'     => 'high',
                            'notification' => ['sound' => 'default'],
                        ],
                    ],
                ]);

            if ($response->successful()) {
                return true;
            }

            Log::error('FCM v1 send failed: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('FCM v1 exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a DATA-ONLY high-priority message (no notification block).
     * This guarantees the app's background handler runs even when the app is
     * terminated — used for the "incoming ride call" so it can ring like a phone call.
     */
    public function sendData(string $token, array $data): bool
    {
        if (empty($token) || !$this->credentials) return false;

        $accessToken = $this->getAccessToken();
        if (!$accessToken) return false;

        $stringData = [];
        foreach ($data as $k => $v) {
            $stringData[$k] = is_scalar($v) ? (string) $v : json_encode($v);
        }

        try {
            $response = Http::withToken($accessToken)
                ->connectTimeout(3)->timeout(6)
                ->post("https://fcm.googleapis.com/v1/projects/{$this->projectId}/messages:send", [
                    'message' => [
                        'token'   => $token,
                        'data'    => $stringData,
                        'android' => [
                            'priority' => 'high',
                            // tells FCM to deliver immediately even in Doze mode
                            'ttl'      => '45s',
                        ],
                        'apns' => [
                            'headers' => ['apns-priority' => '10', 'apns-push-type' => 'background'],
                            'payload' => ['aps' => ['content-available' => 1]],
                        ],
                    ],
                ]);

            if ($response->successful()) return true;
            Log::error('FCM data send failed: ' . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error('FCM data exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send the "incoming ride request call" to a driver (data-only, rings the app).
     */
    public function rideCallToDriver(\App\Models\Driver $driver, array $rideData): bool
    {
        if (empty($driver->fcm_token)) return false;
        return $this->sendData($driver->fcm_token, array_merge($rideData, [
            'type' => 'ride_request',
        ]));
    }

    /**
     * Get a Google OAuth2 access token from the service account (cached ~55 min).
     * Uses native openssl — no extra packages required.
     */
    private function getAccessToken(): ?string
    {
        return Cache::remember('fcm_v1_access_token', 3300, function () {
            try {
                $now = time();
                $header = $this->b64(json_encode(['alg' => 'RS256', 'typ' => 'JWT']));
                $claim  = $this->b64(json_encode([
                    'iss'   => $this->credentials['client_email'],
                    'scope' => 'https://www.googleapis.com/auth/firebase.messaging',
                    'aud'   => 'https://oauth2.googleapis.com/token',
                    'iat'   => $now,
                    'exp'   => $now + 3600,
                ]));

                // openssl_sign can fatal if openssl is disabled or the key is
                // malformed (e.g. \n newlines mangled on upload) — guard it.
                $signature = '';
                if (!openssl_sign("$header.$claim", $signature, $this->credentials['private_key'], 'SHA256')) {
                    Log::error('FCM: openssl_sign failed — check service-account private_key formatting.');
                    return null;
                }
                $jwt = "$header.$claim." . $this->b64($signature);

                $res = Http::asForm()->connectTimeout(3)->timeout(6)
                    ->post('https://oauth2.googleapis.com/token', [
                        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                        'assertion'  => $jwt,
                    ]);
                if ($res->successful()) {
                    return $res->json('access_token');
                }
                Log::error('FCM token error: ' . $res->body());
            } catch (\Throwable $e) {
                Log::error('FCM token exception: ' . $e->getMessage());
            }
            return null;
        });
    }

    private function b64(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
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
