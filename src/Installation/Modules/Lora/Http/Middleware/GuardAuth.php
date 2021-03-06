<?php

namespace Dosarkz\Lora\Installation\Modules\Lora\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuardAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        try
        {
            DB::connection()->getPdo();

            if (!Auth::guard($guard)->check() && $request->getRequestUri() != '/lora/login') {
                return redirect('/lora/login');
            }

        } catch (\Exception $e) {
            return redirect('/');
        }
        return $next($request);
    }
}
