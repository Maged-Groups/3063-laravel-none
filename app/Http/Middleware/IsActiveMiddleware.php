<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isActive = auth()->user()->is_active === 1;

        if (!$isActive)
            abort(response()->json('Your account is not active, please activate your account', 401));
        // abort(response()->json('Your account is not active, please activate your account')->setStatusCode(401));

        return $next($request);
    }
}
