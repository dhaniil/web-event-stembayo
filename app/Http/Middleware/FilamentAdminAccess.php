<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FilamentAdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()){
            return redirect('/');
        }
      
        if (!$request->user()->hasAnyRole(['Super Admin', 'Admin', 'Sekbid'])) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        
        return $next($request);
    }
}
