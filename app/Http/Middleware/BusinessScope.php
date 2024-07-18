<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\URL;
use Closure,Auth;
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

        if($request->business_id != Auth::user()->cid){
            $request->business_id = Auth::user()->cid;
            $currentUrl = $request->url();
            $newUrl = preg_replace('/business\/\d+/', 'business/' . Auth::user()->cid, $currentUrl);
            $request->server->set('REQUEST_URI', $newUrl);
            $request->server->set('QUERY_STRING', parse_url($newUrl, PHP_URL_QUERY));
            return redirect($newUrl);
        }

        $request->current_company = Auth::user()->businesses()->findOrFail($request->business_id);
        
        URL::defaults(['business_id' => $request->current_company->id]);

        return $next($request);
    }
}
