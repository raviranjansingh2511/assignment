<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('web')->user();

        if (!$user) {
            abort(403, 'Please login first');
        }
        

        if ($user->role == 1) {
            return redirect()->route('denied');
        }

        return $next($request);
    }
}
