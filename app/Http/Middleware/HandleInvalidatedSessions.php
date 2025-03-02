<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInvalidatedSessions
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('_token')) {
            Auth::logout();
            return redirect()->route('login')
                ->with('message', 'Your session has expired. Please log in again.');
        }

        return $next($request);
    }
}
