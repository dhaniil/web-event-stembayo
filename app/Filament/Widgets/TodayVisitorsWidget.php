<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class TodayVisitorsWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;


    protected function getStats(): array
    {
        $todayCount = Pengunjung::whereDate('visited_at', Carbon::today())->count();
        $yesterdayCount = Pengunjung::whereDate('visited_at', Carbon::yesterday())->count();
        
        $percentageChange = $yesterdayCount > 0 
            ? (($todayCount - $yesterdayCount) / $yesterdayCount) * 100 
            : 0;

        return [
            Stat::make('Today\'s Visitors', $todayCount)
                ->description($percentageChange >= 0 ? "+{$percentageChange}% from yesterday" : "{$percentageChange}% from yesterday")
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'success' : 'danger')
                ->chart([7, 4, 6, 8, 5, 9, $todayCount]),
        ];
    }
} 