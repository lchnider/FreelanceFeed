<?php

namespace App\Http\Middleware;

use Closure;

class CheckIfInstalled
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
        if (!env('APP_INSTALLED')) {
            if ($request->getpathInfo() != '/install')
                return redirect('/install');
            else return $next($request);
        }

        return $next($request);
    }
}
