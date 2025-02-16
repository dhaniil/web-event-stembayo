<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalUsersWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalPengunjung = User::role('Pengunjung')->count();

        return [
            Stat::make('Total Registered Users', $totalPengunjung)
                ->description('Registered Pengunjung accounts')
                ->icon('heroicon-o-users')
                ->color('info'),
        ];
    }
}