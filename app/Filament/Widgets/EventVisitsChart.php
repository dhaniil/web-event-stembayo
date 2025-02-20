<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\LineChartWidget;
use Carbon\Carbon;

class EventVisitsChart extends LineChartWidget
{
    protected static ?string $heading = 'Pengunjung Event (7 Hari Terakhir)';

    protected function getData(): array
    {
        $data = collect();
        $labels = collect();

        // Get last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $labels->push(Carbon::now()->subDays($i)->format('D'));
            
            // Count visits for each day
            $visits = Event::whereDate('created_at', $date)->sum('visit_count');
            $data->push($visits);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengunjung Event',
                    'data' => $data->toArray(),
                    'fill' => 'start',
                    'borderColor' => '#3c5cff',
                    'backgroundColor' => 'rgba(60, 92, 255, 0.1)',
                    'tension' => 0.3,
                ]
            ],
            'labels' => $labels->toArray(),
        ];
    }
}
