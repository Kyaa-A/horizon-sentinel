<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role;

        // Convert string roles to UserRole enum for comparison
        foreach ($roles as $role) {
            $roleEnum = UserRole::tryFrom($role);

            if ($roleEnum && $userRole === $roleEnum) {
                return $next($request);
            }
        }

        abort(403, 'Access denied. You do not have the required role.');
    }
}
