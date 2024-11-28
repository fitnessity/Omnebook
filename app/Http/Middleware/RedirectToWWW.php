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
        $desiredHost = 'www.omnebook.com';

        if ($request->getHost() !== $desiredHost) {
            // Construct the correct URL
            $newUrl = $request->getScheme() . '://' . $desiredHost . $request->getRequestUri();
            return redirect()->to($newUrl, 301); // Redirect with a 301 status
        }

        // if (strpos($request->getHost(), 'www.') !== 0) {
        //     $newUrl = 'https://www.' . $request->getHost() . $request->getRequestUri();
        //     return redirect()->to($newUrl, 301);
        // }

        return $next($request);
    }
}
