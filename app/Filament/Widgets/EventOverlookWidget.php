<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\DB;

class EventOverlookWidget extends OverlookWidget
{
    protected static ?string $heading = 'Event Overview';

    protected function getStats(): array
    {
        $totalEvents = Event::count();
        $activeEvents = Event::where('status', 'active')->count();
        $totalVisitors = DB::table('pengunjung')->count();

        return [
            'Total Events' => [
                'value' => $totalEvents,
                'description' => 'Total events in system',
                'icon' => 'heroicon-o-calendar',
                'color' => Color::Blue,
            ],
            'Active Events' => [
                'value' => $activeEvents,
                'description' => 'Currently active events',
                'icon' => 'heroicon-o-star',
                'color' => Color::Green,
            ],
            'Total Visitors' => [
                'value' => $totalVisitors,
                'description' => 'Total event visitors',
                'icon' => 'heroicon-o-users',
                'color' => Color::Orange,
            ],
        ];
    }
}
