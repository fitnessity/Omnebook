<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\URL;
use Closure;
use Auth;

class BusinessScope
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
        $request->current_company = Auth::user()->businesses()->findOrFail($request->business_id);
        
        URL::defaults(['business_id' => $request->current_company->id]);

        return $next($request);
    }
}
