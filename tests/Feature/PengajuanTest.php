<?php

use App\Models\User;
use App\Models\Pengajuan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('dapat mengirim pengajuan program pendampingan beserta dokumen (PBI #14)', function () {
    Storage::fake('public');

    // 1. Setup user dummy (karena tabel migration butuh user_id)
    $user = User::factory()->create();

    $file = UploadedFile::fake()->create('dokumen.pdf', 1000, 'application/pdf');

    // 2. Simulasi form submit
    $response = $this->actingAs($user)->post(route('umkm.pengajuan.store'), [
        'kebutuhan_usaha' => 'Butuh pinjaman modal untuk beli mesin produksi baru',
        'dokumen_pendukung' => $file,
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

    $pengajuan = Pengajuan::first();
    expect($pengajuan->dokumen_pendukung)->not->toBeNull();
    Storage::disk('public')->assertExists($pengajuan->dokumen_pendukung);
});
