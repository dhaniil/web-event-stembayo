<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\StatEventPalingRame;
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
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Stembayo')
            ->colors([
                'primary' => Color::Blue,
                'secondary' => Color::Gray,
                'background' => Color::Slate,
                'text' => Color::Gray,
                'accent' => Color::Blue,
                'highlight' => Color::Blue,
                'error' => Color::Red,
                'success' => Color::Green,
                'info' => Color::Blue,
                'warning' => Color::Yellow,

            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            // ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                UserStatsWidget::class,
                TopStatsWidget::class,
                // ChartPengunjung::class,
                StatEventPalingRame::class,
                DailyStatsWidget::class,
                EventOverviewWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
