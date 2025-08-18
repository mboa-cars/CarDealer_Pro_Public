<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePasswordChanged
{
    /**
     * Handle an incoming request.
     * If the authenticated user must change password, redirect them to the change form,
     * except when they are already on that route or logging out.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ($user->must_change_password ?? false)) {
            $routeName = optional($request->route())->getName();

            // Allow access to the change password routes and logout
            $allowed = in_array($routeName, [
                'password.change',
                'password.change.update',
                'logout',
            ], true);

            if (! $allowed) {
                return redirect()->route('password.change');
            }
        }

        return $next($request);
    }
}
