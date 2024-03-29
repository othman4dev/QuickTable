<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    public function handle(Request $request, Closure $next)
    {
        if (! session('user')) {
            dd('User not logged in', session('user'), $request->path());
        }
        return $next($request);
    }
}