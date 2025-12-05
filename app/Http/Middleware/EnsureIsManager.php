<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsManager
{
    /**
     * Handle an incoming request.
     * Allows managers and HR admins to access manager routes.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if (! $request->user()->isManager() && ! $request->user()->isHRAdmin()) {
            abort(403, 'Access denied. Manager or HR Admin privileges required.');
        }

        return $next($request);
    }
}
