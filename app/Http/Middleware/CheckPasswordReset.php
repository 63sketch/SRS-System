<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPasswordReset
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->must_reset_password && !$request->is('force-password-reset*') && !$request->is('logout')) {
            return redirect()->route('password.force-reset');
        }

        return $next($request);
    }
}
