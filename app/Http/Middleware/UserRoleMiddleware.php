<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use function League\Flysystem\has;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user) {
            abort(401);
        }

        // If it's an Admin model instance (from admin guard), we treat it as having 'admin' role
        if ($user instanceof \App\Models\Admin) {
            if ($role === 'admin') {
                return $next($request);
            }
            abort(401);
        }

        // Standard User model role check
        if (method_exists($user, 'hasRole') && !$user->hasRole($role)) {
            abort(401);
        }

        return $next($request);
    }
}
