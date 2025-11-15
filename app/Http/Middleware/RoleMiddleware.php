<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Usage: ->middleware('role:admin') or 'role:admin,staff'
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login');
        }

        if (empty($roles) || in_array($user->role, $roles, true)) {
            return $next($request);
        }

        abort(403, 'You are not allowed to access this page.');
    }
}
