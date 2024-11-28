<?php

namespace App\Http\Middleware;

use Closure;

class RedirectToWWW
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
        if (strpos($request->getHost(), 'www.') !== 0) {
            $newUrl = 'https://www.' . $request->getHost() . $request->getRequestUri();
            return redirect()->to($newUrl, 301);
        }

        return $next($request);
    }
}
