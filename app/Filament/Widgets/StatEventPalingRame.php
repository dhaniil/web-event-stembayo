<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Event;
use phpDocumentor\Reflection\DocBlock\Description;


class StatEventPalingRame extends BaseWidget
{
    // protected static ?string $maxHeight = '400px';
    // protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 3;

    protected function getStats(): array
    {
        return [
            Stat::make('Event Paling Ramai', Event::orderBy('visit_count', 'desc')->first()?->name ?? 'Tidak ada')
                ->description('Event dengan kunjungan terbanyak')
                ->descriptionIcon('heroicon-m-fire')
                ->color('danger'),
        ];
    }
    
}
