<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalEventsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalEvents = Event::count();

        return [
            Stat::make('Total Events', $totalEvents)
                ->description('All events')
                ->icon('heroicon-o-rectangle-stack')
                ->color('warning'),
        ];
    }
}