<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\HttpFoundation\Response;

class MaintenanceMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = trim($request->getPathInfo(), '/');
        $segments = $path === '' ? [] : explode('/', $path);

        $action = $segments[count($segments) - 1] ?? null;
        $previous = $segments[count($segments) - 2] ?? null;

        if ($action !== null && in_array($action, ['enable', 'disable'], true) && $previous === 'maintenance') {
            $secret = count($segments) >= 3 ? $segments[0] : config('maintenance.secret', 'goride-maintenance-secret');
            $expectedSecret = config('maintenance.secret', 'goride-maintenance-secret');

            if ($secret !== $expectedSecret) {
                abort(403, 'Unauthorized');
            }

            if ($action === 'enable') {
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
