<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\CompletedEventsWidget;
use App\Filament\Widgets\MonthlyEventsWidget;
use App\Filament\Widgets\MonthlyVisitorsWidget;
use App\Filament\Widgets\TodayVisitorsWidget;
use App\Filament\Widgets\TotalEventsWidget;
use App\Filament\Widgets\TotalUsersWidget;
use App\Filament\Widgets\TotalVisitorsWidget;
use App\Filament\Widgets\UpcomingEventsWidget;
use App\Filament\Widgets\VisitorChartWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Admin Dashboard';
    
    protected static string $view = 'filament.pages.dashboard';

    // Hapus method getHeaderWidgets() karena kita akan render widget langsung di blade
}
