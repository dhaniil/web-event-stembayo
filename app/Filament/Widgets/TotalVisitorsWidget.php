<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalVisitorsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalVisitors = Pengunjung::count();

        return [
            Stat::make('Total Visitors', $totalVisitors)
                ->description('All time visitors')
                ->icon('heroicon-o-user-group')
                ->color('success'),
        ];
    }
}