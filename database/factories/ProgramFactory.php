<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Program>
 */
class ProgramFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'        => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'quota'       => fake()->numberBetween(10, 100),
            'start_date'  => now(),
            'end_date'    => now()->addMonths(3),
            'status'      => 'active',
        ];
    }
}
