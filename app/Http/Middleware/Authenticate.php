<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if ($request->is('admin/*') or $request->is('admin')) {
                return route('admin.auth.login');
            }
            if ($request->is('company/*') or $request->is('company')) {
                return route('maintenance.auth.login');
            }
            if ($request->is('lawyer/*') or $request->is('lawyer')) {
                return route('lawyer.auth.login');
            }
            return route('user.auth.login');
        }
    }
}
