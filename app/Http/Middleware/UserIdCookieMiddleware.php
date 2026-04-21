<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use Auth;

class UserIdCookieMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  

        $cookie = $request->cookie('user_id');

        if($cookie)
        {
            if($cookie == '-1')
            {

                if($request->user())
                {
                    Cookie::forget('user_id');

                    $name = 'user_id';
                    $value = $request->user()->id;
                    $min = 60 * 24 * 30 * 2; //for 2 months;
                    $newcookie = cookie($name, $value, $min);
                    return $next($request)->cookie($newcookie);
                }

            }  
            else
            {
                if(!$request->user())
                {
                    Cookie::forget('user_id');

                    $name = 'user_id';
                    $value = '-1';
                    $min = 60 * 24 * 30 * 2; //for 2 months;
                    $newcookie = cookie($name, $value, $min);
                    return $next($request)->cookie($newcookie);
                }
            }          
        }else
        {
            if($request->user())
            {
                $name = 'user_id';
                $value = $request->user()->id;
                $min = 60 * 24 * 30 * 2; //for 2 months;
                $newcookie = cookie($name, $value, $min);
                return $next($request)->cookie($newcookie);

            }else
            {
                $name = 'user_id';
                $value = '-1';
                $min = 60 * 24 * 30 * 2; //for 2 months;
                $newcookie = cookie($name, $value, $min);
                return $next($request)->cookie($newcookie);
            }
        }

        return $next($request); 
    }
}
