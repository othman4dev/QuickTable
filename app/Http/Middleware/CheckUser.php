<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUser
{
    public function handle(Request $request, Closure $next)
    {
        if (! session('user')) {
            return redirect('/login');
        }
        return $next($request);
    }
}