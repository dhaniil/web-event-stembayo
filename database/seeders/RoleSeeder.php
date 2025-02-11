<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $sekbid = Role::create(['name' => 'Sekbid']);
        $pengunjung = Role::create(['name' => 'Pengunjung']);

        // Create basic permissions
        $permissions = [
            'view_admin',
            'view_sekbid',
            'view_event',
            'view_berita',
            'view_ulasan',
            'view_activity_log'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign all permissions to Super Admin
        $superAdmin->givePermissionTo(Permission::all());
    }
}
