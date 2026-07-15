<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;

class HiddenMaintenanceMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $segments = $request->segments();

        if (count($segments) === 3 && $segments[1] === 'maintenance' && in_array($segments[2], ['enable', 'disable'], true)) {
            $secret = $segments[0];
            $expectedSecret = config('maintenance.secret', 'goride-maintenance-secret');

            if ($secret !== $expectedSecret) {
                abort(403, 'Unauthorized');
            }

            if ($segments[2] === 'enable') {
                Artisan::call('down', ['--secret' => $secret]);

                return response()->json([
                    'status' => 'maintenance_enabled',
                    'message' => 'The site is now in maintenance mode.',
                ]);
            }

            Artisan::call('up');

            return response()->json([
                'status' => 'maintenance_disabled',
                'message' => 'The site is now live again.',
            ]);
        }

        return $next($request);
    }
}
