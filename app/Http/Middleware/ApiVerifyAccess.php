<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiVerifyAccess
{

    public function handle(Request $request, Closure $next)
    {
        if (isset($request->token)) {
            if ($request->token == env("API_ACCESS_TOKEN")) {
                return $next($request);
            }
            return false;
        }
    }
}
