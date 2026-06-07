<?php

namespace Database\Factories;

use App\Models\SumberPendanaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SumberPendanaan>
 */
class SumberPendanaanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_program' => fake()->sentence(3),
            'mitra_penyalur' => fake()->company(),
            'batas_maksimal' => fake()->randomElement([5000000, 10000000, 25000000, 50000000]),
            'deskripsi' => fake()->paragraph(),
            'persyaratan' => fake()->sentence(),
            'status' => 'aktif',
        ];
    }
}
