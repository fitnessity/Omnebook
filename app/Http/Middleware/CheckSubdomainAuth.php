<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\CompanyInformation;
class CheckSubdomainAuth
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

        if (Auth::check()) {
            $bussiness_id = Auth::user()->cid;
            $unique_code = CompanyInformation::where('id', $bussiness_id)->value('unique_code');
    
            // return redirect()->route('sub_customer_dashboard');
            if ($unique_code) {
                return redirect()->route('sub_customer_dashboard', ['unique_code' => $unique_code]);
            }
            return redirect()->back(); 
        }
        return $next($request);
    }
}
