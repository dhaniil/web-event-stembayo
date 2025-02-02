<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DailyStatsWidget extends BaseWidget
{
    // protected static ?int $sort = 4;
    // protected int | string | array $columnSpan = 2;
    

    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Pengunjung hari ini', Pengunjung::whereDate('visited_at', today())->count())
                ->color('info'),
            
            Stat::make('Jumlah Pengunjung bulan ini', Pengunjung::whereMonth('visited_at', now()->month)->count())
                ->color('success'),
                Stat::make('Total Pengunjung', Pengunjung::count())
                ->description('Jumlah pengunjung keseluruhan')
                ->color('success'),
        ];
    }
}