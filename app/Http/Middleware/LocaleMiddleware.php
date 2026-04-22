<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Cookie;
use Closure;
use Illuminate\Http\Request;

class LocaleMiddleware
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
        $locale = session('locale');

        if (!$locale) {
            $locale = Cookie::get('locale');
        }

        if (!$locale) {
            $locale = config('app.locale');
        }

        if (in_array($locale, config('app.locales'))) {
            \App::setLocale($locale);
            if (!session()->has('locale') || session('locale') !== $locale) {
                session(['locale' => $locale]);
            }
        }

        return $next($request);
    }
}
