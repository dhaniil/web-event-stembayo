<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create test admin user
        $testAdmin = [
            'name' => 'Test Admin',
            'email' => 'testadmin@stembayo.sch.id',
            'password' => bcrypt('password123'),
            'kelas' => '12',
            'jurusan' => 'SIJA A',
        ];

        // Create or update user
        $user = User::updateOrCreate(
            ['email' => $testAdmin['email']],
            $testAdmin
        );

        // Make sure user has Super Admin role
        $user->syncRoles(['Super Admin']);

        // Create original super admins
        $superAdmins = [
            [
                'name' => 'Ahamd Hanaffi Rahmadhani',
                'email' => '20393@student.stembayo.sch.id',
                'password' => bcrypt('20393stembayo'),
                'kelas' => '12',
                'jurusan' => 'SIJA A',
            ],
            [
                'name' => 'Farcha Amalia Nugrahaini',
                'email' => '20408@student.stembayo.sch.id',
                'password' => bcrypt('20408stembayo'),
                'kelas' => '12',
                'jurusan' => 'SIJA A',
            ],
            [
                'name' => 'Laurentius Daviano Maximus Antara',
                'email' => '20421@student.stembayo.sch.id',
                'password' => bcrypt('20421stembayo'),
                'kelas' => '12',
                'jurusan' => 'SIJA A',
            ],
        ];

        foreach ($superAdmins as $admin) {
            $user = User::updateOrCreate(
                ['email' => $admin['email']],
                $admin
            );
            $user->syncRoles(['Super Admin']);
        }
    }
}
