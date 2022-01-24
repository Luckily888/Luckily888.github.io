<?php

namespace App\Http\Middleware;

use Closure;

class SetLocaleAll
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
        if ($request->has('lang') && array_key_exists($request->input('lang'), config('app.locales'))){
            \Session::put('locale', $request->input('lang'));
        }

        if (\Session::has('locale') && \App::getLocale() !== \Session::get('locale')){
            app()->setLocale(\Session::get('locale'));
        }else{
            \Session::put('locale', 'en');
        }
        return $next($request);
    }
}
