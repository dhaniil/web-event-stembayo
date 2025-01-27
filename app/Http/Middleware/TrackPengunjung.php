<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pengunjung;
use Symfony\Component\HttpFoundation\Response;

class TrackPengunjung
{
    public function handle(Request $request, Closure $next)
    {
        Pengunjung::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'visited_at' => now()
        ]);

        return $next($request);
    }
}
