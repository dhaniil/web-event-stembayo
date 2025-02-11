<?php

namespace App\Filament\Widgets;

use App\Models\Pengunjung;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class VisitorChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Visitors Last 7 Days';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 2;


    protected function getData(): array
    {
        $data = collect(range(6, 0))
            ->map(function ($daysAgo) {
                $date = Carbon::now()->subDays($daysAgo);
                return [
                    'date' => $date->format('Y-m-d'),
                    'count' => Pengunjung::whereDate('visited_at', $date)->count(),
                ];
            });

        return [
            'datasets' => [
                [
                    'label' => 'Visitors',
                    'data' => $data->pluck('count')->toArray(),
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(83, 86, 255, 0.1)',
                    'borderColor' => 'rgb(83, 86, 255)',
                ],
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
} 