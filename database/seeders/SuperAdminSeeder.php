<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create Super Admin Role if it doesn't exist
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);

        // Give all permissions to super admin
        $permissions = [
            'view_events',
            'create_events',
            'edit_events',
            'delete_events',
            'manage_users',
            'view_activity_logs',
            'manage_roles',
            'manage_permissions',
            'manage_berita',
            'manage_banners',
            'manage_ulasan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdminRole->syncPermissions($permissions);

        // Create Super Admin User
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $superAdmin->assignRole($superAdminRole);
    }
}
