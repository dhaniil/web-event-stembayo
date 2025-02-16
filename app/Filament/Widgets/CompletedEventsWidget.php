<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CompletedEventsWidget extends BaseWidget
{

    
    protected int | string | array $columnSpan = [
        'default' => 12,
        'sm' => 12,
        'lg' => 6,
    ];

    protected function getStats(): array
    {
        $completedEvents = Event::where('status', 'selesai')->count();

        return [
            Stat::make('Completed Events', $completedEvents)
                ->description('Finished events')
                ->icon('heroicon-o-check-badge')
                ->color('info'),
        ];
    }
}