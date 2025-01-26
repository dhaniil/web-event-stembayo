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
        // Define a gate for admin access
        Gate::define('admin-access', function (User $user) {
            return $user->role === 'admin' || $user->role === 'superadmin';
        });
    }
}
