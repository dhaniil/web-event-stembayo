<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    
    protected $routeMiddleware = [
        // Middleware lainnya
        'role' => \App\Http\Middleware\RoleMiddleware::class,
        'filament-admin' => \App\Http\Middleware\FilamentAdminAccess::class,
        'track-pengunjung' => \App\Http\Middleware\TrackPengunjung::class,
    ];
    
    
}





