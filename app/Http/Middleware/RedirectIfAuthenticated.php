<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if ($guard === 'admin') {
                    return redirect()->route('admin.dashboard');
                } elseif ($guard === 'driver') {
                    return redirect()->route('driver.dashboard');
                } elseif ($guard === 'corporate') {
                    return redirect()->route('corporate.dashboard');
                }

                // Default web guard logic
                $user = Auth::guard($guard)->user();
                if ($user instanceof \App\Models\User) {
                    if ($user->hasRole('admin')) {
                        return redirect()->route('admin.dashboard');
                    } elseif ($user->hasRole('retailer')) {
                        return redirect()->route('retailer.dashboard');
                    }
                }
                
                return redirect(RouteServiceProvider::HOME);
            }
        }

        return $next($request);
    }
}
