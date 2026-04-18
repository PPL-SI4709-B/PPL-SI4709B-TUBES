<?php

use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('dapat mengirim pengajuan program pendampingan (PBI #13)', function () {
    // 1. Setup user dummy (karena tabel migration butuh user_id)
    $user = User::factory()->create();

    // 2. Simulasi form submit
    $response = $this->actingAs($user)->post(route('umkm.pengajuan.store'), [
        'kebutuhan_usaha' => 'Butuh pinjaman modal untuk beli mesin produksi baru',
    ]);

    // 3. Verifikasi
    $response->assertRedirect();
    $response->assertSessionHas('success', 'Pengajuan berhasil dikirim.');

    // 4. Pastikan data masuk DB
    $this->assertDatabaseHas('pengajuans', [
        'user_id' => $user->id,
        'kebutuhan_usaha' => 'Butuh pinjaman modal untuk beli mesin produksi baru',
        'program_name' => 'Pendampingan Akses Layanan Pembiayaan',
        'status' => 'pending',
    ]);
});
