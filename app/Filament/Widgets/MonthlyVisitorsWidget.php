<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class MonthlyVisitorsWidget extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 1;


    protected function getStats(): array
    {
        $thisMonth = Pengunjung::whereMonth('visited_at', Carbon::now()->month)->count();
        $lastMonth = Pengunjung::whereMonth('visited_at', Carbon::now()->subMonth()->month)->count();
        
        $percentageChange = $lastMonth > 0 
            ? (($thisMonth - $lastMonth) / $lastMonth) * 100 
            : 0;

        return [
            Stat::make('This Month\'s Visitors', $thisMonth)
                ->description($percentageChange >= 0 ? "+{$percentageChange}% from last month" : "{$percentageChange}% from last month")
                ->descriptionIcon($percentageChange >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down')
                ->color($percentageChange >= 0 ? 'success' : 'danger'),
        ];
    }
} 