<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        User::class => UserPolicy::class,   
    ];
    
    public function boot(): void
    {
        $this->registerPolicies();

        // Define a gate for admin access using Spatie roles
        Gate::define('admin-access', function (User $user) {
            return $user->hasAnyRole(['Super Admin', 'Admin']) || $user->hasRole('Sekbid');
        });

        // Super Admin can do everything
        Gate::before(function (User $user) {
            if ($user->hasRole('Super Admin')) {
                return true;
            }
        });
    }
}
