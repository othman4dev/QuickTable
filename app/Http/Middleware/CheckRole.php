<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (! session('user')) {
            return redirect('/login');
        } else if ( session('user')->role !== $role) {
            return redirect('/404');
        }
        return $next($request);
    }
}
