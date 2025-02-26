<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
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
            
            // Count visits for each day using the pengunjung table
            $visits = Pengunjung::whereDate('visited_at', $date)->count();
            $data->push($visits);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengunjung Event',
                    'data' => $data->toArray(),
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.2)',
                    'borderColor' => 'rgb(59, 130, 246)',
                ],
            ],
            'labels' => $labels->toArray(),
        ];
    }
}
