<?php

namespace App\Http\Middleware;

use App;
use Cookie;
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

        $locale = session('locale') ?: config('app.locale');
        if (in_array($locale, config('app.locales')))
        {
            App::setLocale($locale);

            if(session('locale') == null)
            {
                session(['locale' => $locale]);
            }
        }

        // $locale = Cookie::get('locale') ?: config('app.locale');
        // if (in_array($locale, config('app.locales')))
        // {
        //     App::setLocale($locale);

        //     if(Cookie::get('locale') == null)
        //     {
        //         $cookie = cookie('locale', $locale, 43200);
        //         return $next($request)->withCookie($cookie);
        //     }
        // }

        return $next($request);
    }
}
