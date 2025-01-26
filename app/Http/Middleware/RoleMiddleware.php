<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Pastikan user sudah login
        if (!$request->user()) {
            abort(403, 'Unauthorized.');
        }

        // Periksa apakah role user termasuk dalam daftar role yang diizinkan
        if (!in_array($request->user()->role, $roles)) {
            abort(403, 'Forbidden.');
        }

        return $next($request);
    }
}
