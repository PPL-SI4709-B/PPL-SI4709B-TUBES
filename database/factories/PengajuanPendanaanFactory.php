<?php

namespace Database\Factories;

use App\Models\PengajuanPendanaan;
use App\Models\SumberPendanaan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PengajuanPendanaan>
 */
class PengajuanPendanaanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'sumber_pendanaan_id' => SumberPendanaan::factory(),
            'jumlah_pengajuan' => fake()->randomElement([500000, 1000000, 2500000]),
            'tujuan_pendanaan' => fake()->sentence(4),
            'deskripsi_kebutuhan' => fake()->paragraph(),
            'dokumen_pendukung' => null,
            'status' => 'diajukan',
            'catatan' => null,
            'reviewed_by' => null,
            'reviewed_at' => null,
            'submitted_at' => now(),
        ];
    }
}
