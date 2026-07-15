<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LicenseController extends Controller
{
    protected function lockFile(): string
    {
        return storage_path('app/license.lock');
    }

    protected function secret(): ?string
    {
        return config('license.control_token');
    }

    protected function checkToken(string $token): void
    {
        $secret = $this->secret();

        if (!$secret || !hash_equals($secret, $token)) {
            abort(403, 'Invalid license token.');
        }
    }

    /**
     * Remote lock / unlock via GET.
     * /license/control/lock/{token}   -> take the app down
     * /license/control/unlock/{token} -> bring the app back up
     */
    public function control(Request $request, string $action, string $token)
    {
        $this->checkToken($token);

        $lockFile = $this->lockFile();

        if (in_array($action, ['lock', 'down'])) {
            if (!File::exists($lockFile)) {
                File::put($lockFile, now()->toDateTimeString());
            }
            $state = 'locked';
        } elseif (in_array($action, ['unlock', 'up'])) {
            File::delete($lockFile);
            $state = 'unlocked';
        } else {
            abort(400, 'Unknown action. Use lock or unlock.');
        }

        return response()->json([
            'status' => 'ok',
            'action' => $action,
            'state'  => $state,
            'locked' => File::exists($lockFile),
        ]);
    }

    /**
     * Check current lock state without changing it.
     * /license/status/{token}
     */
    public function status(Request $request, string $token)
    {
        $this->checkToken($token);

        return response()->json([
            'locked'     => File::exists($this->lockFile()),
            'checked_at' => now()->toDateTimeString(),
        ]);
    }
}
