<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use App\Models\Pengunjung;
use Filament\Widgets\StatsOverviewWidget\Stat;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;


class ChartPengunjung extends ChartWidget
{
    
    protected static ?string $heading = 'Chart pengunjung web 1 minggu';
    // protected static ?string $maxHeight = '400px';
    protected static ?string $pollingInterval = '10s';
    // protected static ?string $maxWidth = '100%';
    // protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 1;


    protected function getData(): array
    {
        $days = collect(range(6, 0))->map(fn ($day) => Carbon::today()->subDays($day));

        $visitors = $days->map(fn ($date) =>
            Pengunjung::whereDate('visited_at', $date)->count()
        )->toArray();

        $labels = $days->map(fn ($date) =>
            $date->format('d M')
        )->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengunjung',
                    'data' => $visitors,
                    'fill' => true,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)', // Light blue background
                    'borderColor' => 'rgb(59, 130, 246)', // Blue border
                    'borderWidth' => 2,
                    'tension' => 0.4, // Smooth curve
                    'pointBackgroundColor' => 'rgb(59, 130, 246)',
                    'pointBorderColor' => '#ffffff',
                    'pointBorderWidth' => 2,
                    'pointRadius' => 4,
                    'pointHoverRadius' => 6,
                    'pointHoverBackgroundColor' => '#ffffff',
                    'pointHoverBorderColor' => 'rgb(59, 130, 246)',
                    'pointHoverBorderWidth' => 2,
                ]
            ],
            'labels' => $labels
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }

}
