<?php

namespace App\Http\Middleware;

use Closure;

class CheckForKyc
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
        if (geoip($_SERVER['REMOTE_ADDR'])->iso_code != 'US' || auth()->user()->kyc_verified_at){
            return $next($request);
        }

        return redirect('kyc');
    }
}
