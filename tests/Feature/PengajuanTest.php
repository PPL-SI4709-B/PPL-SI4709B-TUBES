<?php

use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('UMKM dapat mengirim pengajuan program beserta dokumen (PBI #13 #14)', function () {
    Storage::fake('local');

    $user = User::factory()->create(['role' => 'umkm', 'profile_status' => 'verified']);
    $program = Program::factory()->create(['status' => 'active', 'jenis' => 'pembinaan']);
    $file = UploadedFile::fake()->create('dokumen.pdf', 500, 'application/pdf');

    $response = $this->actingAs($user)->post(route('umkm.pengajuan.store'), [
        'program_id' => $program->id,
        'kebutuhan_usaha' => 'Butuh modal untuk beli mesin produksi',
        'dokumen_pendukung' => $file,
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('pengajuans', [
        'user_id' => $user->id,
        'program_id' => $program->id,
        'kebutuhan_usaha' => 'Butuh modal untuk beli mesin produksi',
        'status' => 'pending',
    ]);

    $pengajuan = Pengajuan::first();
    expect($pengajuan->dokumen_pendukung)->not->toBeNull();
    Storage::disk('local')->assertExists($pengajuan->dokumen_pendukung);
});

it('UMKM tidak dapat mengakses halaman pengajuan tanpa login', function () {
    $response = $this->get(route('umkm.pengajuan.index'));
    $response->assertRedirect(route('login'));
});

it('Dinas tidak dapat mengakses halaman UMKM', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);

    $response = $this->actingAs($dinas)->get(route('umkm.pengajuan.index'));
    $response->assertForbidden();
});

it('UMKM tidak dapat mengakses halaman dinas', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);

    $response = $this->actingAs($umkm)->get(route('dinas.dashboard'));
    $response->assertForbidden();
});
