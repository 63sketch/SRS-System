<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (! $request->user() || ! $request->user()->role || ! $request->user()->role->permissions()->where('key_name', $permission)->exists()) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
