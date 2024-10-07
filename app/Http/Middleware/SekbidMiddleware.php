<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SekbidMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->role !== 'sekbid' && auth()->user()->role !== 'admin') {
            return redirect('/home')->with('error', 'You do not have access to this page');
        }
        return $next($request);
    }
    
}
