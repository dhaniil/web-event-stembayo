<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MonthlyEventsWidget extends BaseWidget
{

    
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $thisMonthEvents = Event::whereMonth('start_date', Carbon::now()->month)->count();

        return [
            Stat::make('This Month Events', $thisMonthEvents)
                ->description('Events this month')
                ->icon('heroicon-o-calendar-days')
                ->color('primary'),
        ];
    }
    
}