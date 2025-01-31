<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use App\Models\Pengunjung;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TopStatsWidget extends BaseWidget
{
    // protected static ?int $sort = 1;
    // protected int | string | array $columnSpan = 2;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Event', Event::count())
                ->description('Jumlah event keseluruhan')
                ->color('primary'),
            
            Stat::make('Total Pengunjung', Pengunjung::count())
                ->description('Jumlah pengunjung keseluruhan')
                ->color('success'),
        ];
    }
}