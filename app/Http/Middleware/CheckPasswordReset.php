<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordReset
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip for public routes or reset routes to avoid circular redirect
        if ($request->routeIs('login', 'register', 'password.*', 'auth.*', 'password.force-reset', 'password.force-reset.store', 'logout')) {
            return $next($request);
        }

        // If user is authenticated and must reset password
        if (auth()->check() && auth()->user()->must_reset_password) {
            return redirect()->route('password.force-reset');
        }

        return $next($request);
    }
}
