<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Spatie\Permission\Models\Role;

class UserStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        return [
            Stat::make('Admin Users', User::role('Admin')->count())
                ->icon('heroicon-o-user-circle')
                ->color('primary'),
            
            Stat::make('Super Admin Users', User::role('Super Admin')->count())
                ->icon('heroicon-o-shield-check')
                ->color('success'),
            
            // Stat::make('Regular Users', User::role('')->count())
            //     ->icon('heroicon-o-users')
            //     ->color('info'),
        ];
    }
}