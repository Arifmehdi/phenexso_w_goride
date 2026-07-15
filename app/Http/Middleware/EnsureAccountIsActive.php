<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureAccountIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $guards = ['web', 'driver', 'corporate', 'admin'];
        $user = null;
        $activeGuard = null;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                $activeGuard = $guard;
                break;
            }
        }

        if ($user) {
            // Admins are always active
            if ($activeGuard === 'admin') {
                return $next($request);
            }

            $isPending = false;
            
            // Check status field
            if (isset($user->status)) {
                if ($user->status === 'pending' || $user->status === 0 || $user->status === '0') {
                    $isPending = true;
                }
            }

            // Check is_approve field (used by some roles like rider)
            if (isset($user->is_approve) && !$user->is_approve && isset($user->role) && $user->role === 'rider') {
                $isPending = true;
            }

            if ($isPending) {
                Auth::guard($activeGuard)->logout();
                return redirect()->route('login')->with('error', 'Your account is pending approval. Please wait for the administrator to approve your account.');
            }
        }

        return $next($request);
    }
}
