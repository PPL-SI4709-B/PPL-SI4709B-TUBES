<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'location' => fake()->city(),
            'event_date' => now()->addDays(fake()->numberBetween(1, 30)),
            'quota' => fake()->numberBetween(10, 100),
            'type' => 'pelatihan',
            'status' => 'active',
        ];
    }
}
