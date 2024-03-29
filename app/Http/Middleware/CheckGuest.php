<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckGuest
{
    public function handle(Request $request, Closure $next)
    {
        if (session('user')) {
            return redirect('/');
        }
        return $next($request);
    }
}
