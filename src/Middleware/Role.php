<?php

namespace Dosarkz\Dosmin\Middleware;

use Closure;

class Role
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user('admin')->hasRole($role)) {
            return redirect()->back()->with('error', "You are don't have permission for view");
        }

        return $next($request);
    }
}
