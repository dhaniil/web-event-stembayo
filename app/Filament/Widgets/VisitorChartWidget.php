<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;

class VisitorChartWidget extends LineChartWidget
{
    protected static ?string $heading = 'Visitor Statistics (Last 7 Days)';
    protected int | string | array $columnSpan = '6';
    

    protected function getData(): array
    {
        $data = collect();
        
        // Get data for the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            $visitors = Pengunjung::whereDate('created_at', $date)->count();
            
            $data->push([
                'date' => $date->format('d M'),
                'visitors' => $visitors,
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Daily Visitors',
                    'data' => $data->pluck('visitors')->toArray(),
                    'borderColor' => '#1a56db',
                    'fill' => false,
                ]
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }
}
