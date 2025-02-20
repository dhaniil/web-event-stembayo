<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalUsersWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $newUsers = User::where('created_at', '>=', now()->subDays(7))->count();
        $userIncrease = $totalUsers > 0 
            ? round(($newUsers / $totalUsers) * 100, 1) 
            : 0;

        return [
            Stat::make('Total User', $totalUsers)
                ->description($userIncrease . '% peningkatan')
                ->descriptionIcon('heroicon-m-user-group')
                ->chart([4, 7, 8, 10, 12, 15, $totalUsers])
                ->color('success'),
        Stat::make('Admin', User::role('admin')->count())
            ->description('Total Admin')
            ->descriptionIcon('heroicon-m-shield-check')
            ->chart([2, 3, 3, 4, 4, 5, User::role('admin')->count()])
            ->color('warning'),
        Stat::make('Sekbid', User::role('sekbid')->count())
            ->description('Total Sekbid')
            ->descriptionIcon('heroicon-m-shield-check')
            ->chart([2, 3, 3, 4, 4, 5, User::role('sekbid')->count()])
            ->color('indigo'),
        ];
    }
}
