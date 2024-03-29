<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user_role = session('user')->role;
        if (! session('user')) {
            return redirect('/login');
        } else if ( $user_role !== $role) {
            return redirect('/404');
        }
        return $next($request);
    }
}
