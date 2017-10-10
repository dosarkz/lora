<?php

namespace Dosarkz\LaravelAdmin\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        if (!Auth::guard($guard)->check() && $request->getRequestUri() != '/admin/login') {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
