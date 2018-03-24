<?php

namespace App\Http\Middleware;

use Closure;

class RoleGuard
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
        if (!\Auth::user()->canDo(\Request::route()->getName())) {
            return redirect("/401");
        }
        return $next($request);
    }
}
