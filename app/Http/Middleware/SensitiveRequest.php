<?php

namespace App\Http\Middleware;

use Closure;
use App\Steganography;

class SensitiveRequest
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
        if (!Steganography::check($request, Auth()->user)) {
            return redirect('/guayando');
        }
        return $next($request);
    }
}
