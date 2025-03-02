<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles
        $roles = [
            'Super Admin',
            'Admin',
            'Sekbid',
            'Pengunjung'
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Buat permissions dasar
        $permissions = [
            'view_admin',
            'view_sekbid',
            'view_event',
            'create_event',
            'edit_event',
            'delete_event',
            'view_berita',
            'create_berita',
            'edit_berita',
            'delete_berita',
            'view_ulasan',
            'create_ulasan',
            'edit_ulasan',
            'delete_ulasan',
            'view_activity_log',
            'manage_users',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions ke roles
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $adminRole = Role::where('name', 'Admin')->first();
        $sekbidRole = Role::where('name', 'Sekbid')->first();
        $pengunjungRole = Role::where('name', 'Pengunjung')->first();

        // Super Admin mendapatkan semua permissions
        $superAdminRole->givePermissionTo(Permission::all());

        // Admin mendapatkan sebagian besar permissions
        $adminRole->givePermissionTo([
            'view_admin',
            'view_event',
            'create_event',
            'edit_event',
            'delete_event',
            'view_berita',
            'create_berita',
            'edit_berita',
            'delete_berita',
            'view_ulasan',
            'manage_users',
            'view_activity_log',
        ]);

        // Sekbid mendapatkan permissions terkait event
        $sekbidRole->givePermissionTo([
            'view_sekbid',
            'view_event',
            'create_event',
            'edit_event',
            'view_berita',
            'create_berita',
            'edit_berita',
        ]);

        // Pengunjung mendapatkan permissions minimal
        $pengunjungRole->givePermissionTo([
            'view_event',
            'view_berita',
            'create_ulasan',
        ]);
    }
}
