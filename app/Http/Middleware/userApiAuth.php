<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class userApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check user token
        $user = User::where('user_token', $request->token)->first();
        if($user){
            return $next($request);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid token',
            ], 401);
        }

    }
}
