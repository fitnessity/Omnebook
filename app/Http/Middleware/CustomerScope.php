<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\URL;
use Closure;
use Auth;

class CustomerScope
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
        $company =  Auth::user()->businesses()->findOrFail($request->business_id);
        $request->current_customer = $company->customers()->findOrFail($request->customer_id);
        
        URL::defaults(['customer_id' => $request->current_customer->id]);

        return $next($request);
    }
}
