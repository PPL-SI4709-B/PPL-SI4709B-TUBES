<?php

namespace Database\Factories;

use App\Models\Scale;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Scale>
 */
class ScaleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Mikro', 'Kecil', 'Menengah', 'Besar']),
            'description' => fake()->sentence(),
        ];
    }
}
