<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CheckDomainChange extends Command
{
    protected $signature = 'domain:check';
    protected $description = 'Check if the app domain changed and email the details.';

    public function handle(): int
    {
        $currentHost = parse_url(config('app.url', ''), PHP_URL_HOST) ?: request()->getHost();
        $markerPath = base_path('domain-check.txt');
        $storedHost = file_exists($markerPath) ? trim(file_get_contents($markerPath)) : null;

        if (empty($currentHost)) {
            $this->warn('No domain detected.');
            return self::SUCCESS;
        }

        if ($storedHost && strtolower($storedHost) !== strtolower($currentHost)) {
            $this->info('Domain changed from ' . $storedHost . ' to ' . $currentHost);

            $emailTo = config('mail.domain_alert_to', 'you@example.com');
            Mail::raw(
                "Domain change detected.\n\nOld domain: {$storedHost}\nNew domain: {$currentHost}\nTime: " . now()->toDateTimeString(),
                function ($message) use ($emailTo, $currentHost, $storedHost) {
                    $message->to($emailTo)
                        ->subject('Domain change detected for GoRide');
                }
            );
        }

        file_put_contents($markerPath, $currentHost);

        return self::SUCCESS;
    }
}
