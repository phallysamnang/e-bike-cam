<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        foreach ($roles as $role) {
            if ($request->user() && $request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized. You do not have the required role.');
    }
}
