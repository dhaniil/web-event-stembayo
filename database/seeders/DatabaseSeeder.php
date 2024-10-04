<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Seed a random event
        \App\Models\Event::factory()->create([
            'title' => 'Tech Conference 2024',
            'date' => '2024-12-15',
            'description' => 'A conference focusing on the latest advancements in technology.',
            'price' => 150.00,
            'location' => 'Sleman',
            'type' => 'Technology',
            'img_url' => 'https://via.placeholder.com/600x400.png', // Placeholder image
        ]);
    }
}