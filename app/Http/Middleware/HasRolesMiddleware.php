<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {

        $routeRoles = explode('|', $roles);

        foreach ($routeRoles as $role)
            if (auth()->user()->tokenCan($role))
                return $next($request);

        abort(response()->json('You are not allowed to do this action...')->setStatusCode(401));

    }
}
