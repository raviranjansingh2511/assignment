<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Isnotadmin
{
    public function handle(Request $request, Closure $next, $guard = 'web')
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/admin/dashboard'); // already logged in
        }
        return $next($request);
    }
}
