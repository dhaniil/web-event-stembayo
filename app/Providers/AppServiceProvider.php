<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Add CORS headers
        if (request()->isMethod('OPTIONS')) {
            app()->router->options('{all}', function () {
                return response('', 200)
                    ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
                    ->header('Access-Control-Allow-Headers', 'Content-Type, X-Auth-Token, Origin');
            })->where('all', '.*');
        }
    }
}
