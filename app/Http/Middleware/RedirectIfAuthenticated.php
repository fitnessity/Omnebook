<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        /*if(!auth()->guard('admin')->user()){
            return redirect('/admin');
        }
        return $next($request);*/

        if (Auth::guard($guard)->check()) {
            if ($guard == 'admin') {
                return redirect('/admin');
            } elseif ($guard == 'web') {
                return redirect('/userlogin');
            }
        }

        return $next($request);

    }
}
