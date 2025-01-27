<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class EventOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Event', Event::count())
                ->description('Jumlah Event')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('primary'),
                
            Stat::make('Event akan Datang', Event::where('start_date', '>', now())->count())
                ->description('Event yang akan datang')
                ->descriptionIcon('heroicon-m-clock')
                ->color('success'),
                
            Stat::make('Event Terdekat', Event::where('start_date', '>', now())->orderBy('start_date', 'asc')->first()?->name ?? 'Tidak ada')
                ->description('Event terdekat')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }
}