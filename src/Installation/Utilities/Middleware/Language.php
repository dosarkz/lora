<?php

namespace Dosarkz\Lora\Middleware;

use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            app()->setLocale(session()->get('locale'));
        } else {
            app()->setLocale(config('app.fallback_locale'));
        }


        return $next($request);
    }
}
