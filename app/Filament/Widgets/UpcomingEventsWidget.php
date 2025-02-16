<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UpcomingEventsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $upcomingEvents = Event::where('start_date', '>', now())->count();

        return [
            Stat::make('Upcoming Events', $upcomingEvents)
                ->description('Scheduled events')
                ->icon('heroicon-o-calendar')
                ->color('success')
                ->chart([3, 5, 2, 8, 4, 6, 5, 3]),
        ];
    }
}