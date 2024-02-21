<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        /*$user = $request->user();
        if($user && $user->role == "admin") {
            return $next($request);
        }else {
            return redirect('/admin');
        }*/
        
        if(auth()->guard('admin')->user()){
            return $next($request);
        }else{
            return redirect('/admin');
        }
    }
}
?>