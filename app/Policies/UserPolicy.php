<?php

namespace App\Policies;

use App\Models\User;
use App\UserRole;


class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value,
        ]);
    }

    public function view(User $user, User $model): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value,
        ]);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value,
        ]);
    }

    public function update(User $user, User $model): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value,
        ]);
    }

    public function delete(User $user, User $model): bool
    {
        return in_array($user->role, [
            UserRole::SuperAdmin->value,
            UserRole::Admin->value,
        ]);
    }

}
