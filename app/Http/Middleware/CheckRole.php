<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check() || !auth()->user()->roles->whereIn('name', $roles)->count()) {
            abort(401, 'This action is unauthorized.');
        }
        return $next($request);
    }

}
