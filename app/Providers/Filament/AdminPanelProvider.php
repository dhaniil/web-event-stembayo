<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\StatEventPalingRame;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use App\Filament\Widgets\EventOverviewWidget;
use App\Filament\Widgets\ChartPengunjung;
use App\Filament\Widgets\UserStatsWidget;
use App\Filament\Widgets\TopStatsWidget;
use App\Filament\Widgets\DailyStatsWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    // protected function getColumns(): int | array
    // {
    //     return 3;
    // }
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            // ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => [
                    50  => '235,248,255',
                    100 => '210,240,255',
                    200 => '175,225,255',
                    300 => '140,210,255',
                    400 => '105,195,255',
                    500 => '70,180,255',
                    600 => '55,160,230',
                    700 => '45,140,200',
                    800 => '35,120,170',
                    900 => '25,100,140',
                    950 => '15,80,110',
                ],
            ])
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Stembayo')
            // ->colors([
            //     'primary' => Color::Blue,
            //     'secondary' => Color::Gray,
            //     'background' => Color::Slate,
            //     'text' => Color::Gray,
            //     'accent' => Color::Blue,
            //     'highlight' => Color::Blue,
            //     'error' => Color::Red,
            //     'success' => Color::Green,
            //     'info' => Color::Blue,
            //     'warning' => Color::Yellow,

            // ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
