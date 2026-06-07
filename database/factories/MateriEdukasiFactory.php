<?php

namespace Database\Factories;

use App\Models\MateriEdukasi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MateriEdukasi>
 */
class MateriEdukasiFactory extends Factory
{
    protected $model = MateriEdukasi::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'file_path' => 'materi/'.fake()->uuid().'.pdf',
            'thumbnail_path' => null,
        ];
    }
}
