<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role Super Admin sudah ada
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin']);

        // Buat user Super Admin jika belum ada
        $superAdmin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Assign role Super Admin
        $superAdmin->assignRole($superAdminRole);

        // Tambahkan email Super Admin ke protected emails
        $this->command->info('Super Admin created successfully!');
        $this->command->info('Email: admin@admin.com');
        $this->command->info('Password: password');
        $this->command->info('Please change the password after first login!');
    }
}
