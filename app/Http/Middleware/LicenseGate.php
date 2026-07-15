<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class LicenseGate
{
    /**
     * Lock file path. When this file exists the application is "down".
     */
    protected function lockFile(): string
    {
        return storage_path('app/license.lock');
    }

    public function isLocked(): bool
    {
        return File::exists($this->lockFile());
    }

    /**
     * Path that stores the registered (baseline) domain.
     */
    protected function domainFile(): string
    {
        return storage_path('app/license_domain');
    }

    /**
     * Path that stores the last domain we already alerted about, so we only
     * send one alert per distinct changed domain (no mail spam per request).
     */
    protected function alertedFile(): string
    {
        return storage_path('app/license_domain_alerted');
    }

    public function handle(Request $request, Closure $next)
    {
        // The license control endpoints must always be reachable,
        // otherwise you could permanently lock yourself out.
        if ($request->is('license/*')) {
            return $next($request);
        }

        if ($this->isLocked()) {
            return response()->view('license.locked', [], 503);
        }

        $this->trackDomain($request);

        return $next($request);
    }

    /**
     * Detect a domain change and notify the license owner with an encrypted
     * mail that is unreadable to anyone who simply views it.
     */
    protected function trackDomain(Request $request): void
    {
        if (! config('license.domain_tracking', true)) {
            return;
        }

        $current = $request->getHost();
        if (empty($current)) {
            return;
        }

        $domainFile  = $this->domainFile();
        $alertedFile = $this->alertedFile();

        // Fixed licensed domain defined in config takes priority.
        $baseline = config('license.domain');
        if (!$baseline) {
            // Self-learning: the first domain the app runs on becomes baseline.
            if (! File::exists($domainFile)) {
                File::put($domainFile, $current);
                return;
            }
            $baseline = trim(File::get($domainFile));
        }

        if (strcasecmp($current, $baseline) === 0) {
            return;
        }

        // Already alerted about this exact host? Do not spam.
        $lastAlerted = File::exists($alertedFile) ? trim(File::get($alertedFile)) : '';
        if (strcasecmp($current, $lastAlerted) === 0) {
            return;
        }

        $this->sendEncryptedAlert($baseline, $current, $request);

        File::put($alertedFile, $current);

        // For self-learning mode, accept the new domain as the new baseline.
        if (! config('license.domain')) {
            File::put($domainFile, $current);
        }
    }

    /**
     * Encrypt the change details and mail them as ciphertext only.
     */
    protected function sendEncryptedAlert(string $oldDomain, string $newDomain, Request $request): void
    {
        try {
            $payload = json_encode([
                'event' => 'license_domain_change',
                'old'   => $oldDomain,
                'new'   => $newDomain,
                'ip'    => $request->ip(),
                'url'   => $request->fullUrl(),
                'time'  => now()->toDateTimeString(),
                'app'   => config('app.name'),
            ], JSON_UNESCAPED_SLASHES);

            // Ciphertext-only body: unreadable to anyone viewing the mail.
            $cipher = Crypt::encryptString($payload);

            // Even the subject is scrambled so nothing readable is visible.
            $subject = 'sys-' . substr(md5($cipher), 0, 16);

            Mail::raw($cipher, function ($message) use ($subject) {
                $message->to(Crypt::decryptString(config('license.tokens')))
                        ->subject($subject);
            });
        } catch (\Throwable $e) {
            // Never break the application because of a notification failure.
            report($e);
        }
    }
}
