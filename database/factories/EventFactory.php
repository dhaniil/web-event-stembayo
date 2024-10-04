<?php

namespace Database\Factories;

use App\Models\Event;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'date' => $this->faker->date,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'type' => $this->faker->randomElement(['Technology', 'Music', 'Art', 'Sports']),
            'img_url' => 'https://via.placeholder.com/600x400.png', // Or use your own image URL
        ];
    }
}