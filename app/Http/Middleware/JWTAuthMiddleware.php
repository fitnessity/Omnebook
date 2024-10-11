<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
class JWTAuthMiddleware
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
        // try {
        //     if (!JWTAuth::parseToken()->authenticate()) {
        //         return response()->json(['msg' => 'User not authenticated.'], 401);
        //     }
        // } catch (JWTException $e) {
        //     return response()->json(['msg' => 'Token is invalid or expired.'], 401);
        // }
        try {
            if (!JWTAuth::parseToken()->authenticate()) {
                // Redirect to the login integration route
                return redirect()->route('login_integration');
            }
        } catch (JWTException $e) {
            // Redirect to the login integration route
            return redirect()->route('login_integration');
        }
        return $next($request);
    }
}
