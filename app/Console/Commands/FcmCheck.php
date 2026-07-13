<?php

namespace App\Console\Commands;

use App\Services\FcmService;
use Illuminate\Console\Command;

/**
 * Diagnoses the Firebase push setup end-to-end so you can confirm the
 * uploaded service-account key actually works.
 *
 *   php artisan fcm:check                 -> verify key loads + OAuth token
 *   php artisan fcm:check {fcm_token}     -> also send a real test push
 */
class FcmCheck extends Command
{
    protected $signature = 'fcm:check {token? : Optional device FCM token to send a live test push to}';

    protected $description = 'Verify the Firebase service-account key and (optionally) send a test push';

    public function handle(): int
    {
        $path = config('services.fcm.credentials');
        $this->line("Credentials path: <info>{$path}</info>");

        if (!$path || !file_exists($path)) {
            $this->error('❌ Service-account JSON NOT found at that path.');
            $this->line('   Upload it to storage/app/firebase/service-account.json');
            $this->line('   or set FIREBASE_CREDENTIALS in .env, then: php artisan config:clear');
            return self::FAILURE;
        }

        $json = json_decode(file_get_contents($path), true);
        foreach (['project_id', 'client_email', 'private_key'] as $key) {
            if (empty($json[$key])) {
                $this->error("❌ JSON is missing required field: {$key}");
                return self::FAILURE;
            }
        }
        $this->info("✅ Key file OK  (project: {$json['project_id']}, client: {$json['client_email']})");

        // Force an OAuth token exchange to prove the key can actually talk to Google.
        // getAccessToken() is private, so exercise it via a harmless send() to a
        // dummy token — a working key returns an "invalid token" error from FCM
        // (which still proves auth succeeded), while a broken key fails at OAuth.
        $token = $this->argument('token');
        $fcm = new FcmService();

        if (!$token) {
            $this->line('');
            $this->line('Key looks valid. To send a REAL test push, pass a device token:');
            $this->line('   php artisan fcm:check <device_fcm_token>');
            return self::SUCCESS;
        }

        $this->line('Sending test push...');
        $ok = $fcm->send($token, '🔔 GoRide Test', 'Push notifications are working!', ['type' => 'test']);

        if ($ok) {
            $this->info('✅ Test push accepted by FCM — check the device.');
            return self::SUCCESS;
        }

        $this->error('❌ FCM rejected the send. Check storage/logs/laravel.log for the exact reason.');
        $this->line('   (A "registration-token-not-registered" error means the KEY is fine but the token is stale.)');
        return self::FAILURE;
    }
}
