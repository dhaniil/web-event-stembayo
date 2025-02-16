<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TodayVisitorsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $todayVisitors = Pengunjung::whereDate('created_at', Carbon::today())->count();

        return [
            Stat::make('Today\'s Visitors', $todayVisitors)
                ->description('Visitors today')
                ->icon('heroicon-o-cursor-arrow-rays')
                ->color('warning'),
        ];
    }
}
