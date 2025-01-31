<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\UserRole;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected static ?string $pollingInterval = '30s';
    // protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $totalUsers = User::count();
        $newUsersToday = User::whereDate('created_at', today())->count();
        $adminCount = User::whereIn('role', [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value
        ])->count();
        
        return [
            Stat::make('Total Users', $totalUsers)
                ->description("$newUsersToday baru hari ini")
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
                ->chart([7, 4, 6, 8, 10, $totalUsers])
                ->icon('heroicon-o-users'),

            Stat::make('Admin Users', $adminCount)
                ->description('Superadmin & Admin')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('warning')
                ->chart([1, 2, 1, 3, $adminCount])
                ->icon('heroicon-o-shield-check'),

            Stat::make('Regular Users', User::where('role', UserRole::Pengunjung->value)->count())
                ->description('User biasa')
                ->descriptionIcon('heroicon-m-user')
                ->color('success')
                ->chart([2, 4, 6, 8, 10, 12])
                ->icon('heroicon-o-user-group'),
        ];
    }
}