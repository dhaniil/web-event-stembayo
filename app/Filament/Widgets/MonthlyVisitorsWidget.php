<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonthlyVisitorsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $monthlyVisitors = Pengunjung::whereMonth('created_at', Carbon::now()->month)->count();

        return [
            Stat::make('Monthly Visitors', $monthlyVisitors)
                ->description('This month\'s visitors')
                ->icon('heroicon-o-users')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
        ];
    }
}
