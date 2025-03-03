<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Vite;
use Filament\Facades\Filament;

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
        // Configure Vite manifest path
        Vite::useManifestFilename('.vite/manifest.json');

        // Configure Filament assets
        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/filament/admin/theme.css');
        });
    }
}
