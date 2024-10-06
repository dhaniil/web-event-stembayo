<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')->insert([
            [
                'name' => 'Event 1',
                'date' => '2024-10-10',
                'description' => 'Deskripsi untuk Event 1',
                'type' => 'Type A',
                'image' => null, 
                'sekbid' => 'KTYME Islam',
                'penyelenggara' => 'Penyelenggara 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Event 2',
                'date' => '2024-10-15',
                'description' => 'Deskripsi untuk Event 2',
                'type' => 'Type B',
                'image' => null, 
                'sekbid' => 'KTYME Kristiani',
                'penyelenggara' => 'Penyelenggara 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Event 3',
                'date' => '2024-10-20',
                'description' => 'Deskripsi untuk Event 3',
                'type' => 'Type C',
                'image' => null, 
                'sekbid' => 'KBBP',
                'penyelenggara' => 'Penyelenggara 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Event 4',
                'date' => '2024-10-25',
                'description' => 'Deskripsi untuk Event 4',
                'type' => 'Type D',
                'image' => null,
                'sekbid' => 'PAKS',
                'penyelenggara' => 'PAKS',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Event 5',
                'date' => '2024-10-30',
                'description' => 'Deskripsi untuk Event 5',
                'type' => 'Type E',
                'image' => null,
                'sekbid' => 'KK',
                'penyelenggara' => 'KK',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Event 6',
                'date' => '2024-11-05',
                'description' => 'Deskripsi untuk Event 6',
                'type' => 'Type F',
                'image' => null,
                'sekbid' => '-',
                'penyelenggara' => 'Pihak Sekolah',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
