<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Awcodes\Overlook\Widgets\OverlookWidget;
use Filament\Support\Colors\Color;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VisitorTrendsWidget extends OverlookWidget
{
    protected static ?string $heading = 'Visitor Trends';

    protected function getStats(): array
    {
        $today = Carbon::today();
        $thisWeek = Carbon::now()->startOfWeek();
        $thisMonth = Carbon::now()->startOfMonth();

        $todayVisitors = Pengunjung::whereDate('created_at', $today)->count();
        $weeklyVisitors = Pengunjung::where('created_at', '>=', $thisWeek)->count();
        $monthlyVisitors = Pengunjung::where('created_at', '>=', $thisMonth)->count();
        
        // Get most visited event
        $mostVisitedEvent = DB::table('pengunjung')
            ->join('events', 'pengunjung.event_id', '=', 'events.id')
            ->select('events.name', DB::raw('count(*) as total'))
            ->groupBy('events.id', 'events.name')
            ->orderByDesc('total')
            ->first();

        return [
            'Today' => [
                'value' => $todayVisitors,
                'description' => 'Visitors today',
                'icon' => 'heroicon-o-clock',
                'color' => Color::Blue,
            ],
            'This Week' => [
                'value' => $weeklyVisitors,
                'description' => 'Visitors this week',
                'icon' => 'heroicon-o-calendar-days',
                'color' => Color::Green,
            ],
            'This Month' => [
                'value' => $monthlyVisitors,
                'description' => 'Visitors this month',
                'icon' => 'heroicon-o-calendar',
                'color' => Color::Orange,
            ],
            'Most Visited Event' => [
                'value' => $mostVisitedEvent?->name ?? 'No data',
                'description' => $mostVisitedEvent ? "{$mostVisitedEvent->total} visitors" : '',
                'icon' => 'heroicon-o-trophy',
                'color' => Color::Rose,
            ],
        ];
    }
}
