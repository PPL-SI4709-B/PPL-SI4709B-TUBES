<?php

namespace Database\Factories;

use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pengajuan>
 */
class PengajuanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'program_id' => Program::factory(),
            'jenis' => 'pembinaan',
            'kebutuhan_usaha' => fake()->paragraph(),
            'dokumen_pendukung' => null,
            'status' => 'pending',
            'notes' => null,
        ];
    }
}
