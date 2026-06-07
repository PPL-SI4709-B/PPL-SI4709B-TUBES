<?php

use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('Dokumen pengajuan disimpan di disk privat (local), bukan public', function () {
    Storage::fake('local');

    $user = User::factory()->create(['role' => 'umkm', 'profile_status' => 'verified']);
    $program = Program::factory()->create(['status' => 'active', 'jenis' => 'pembinaan']);
    $file = UploadedFile::fake()->create('dokumen.pdf', 100, 'application/pdf');

    $this->actingAs($user)->post(route('umkm.pengajuan.store'), [
        'program_id' => $program->id,
        'kebutuhan_usaha' => 'Butuh modal mesin produksi baru',
        'dokumen_pendukung' => $file,
    ]);

    $pengajuan = Pengajuan::first();
    expect($pengajuan->dokumen_pendukung)->not->toBeNull();
    Storage::disk('local')->assertExists($pengajuan->dokumen_pendukung);
});

it('Pemilik dapat mengunduh dokumennya sendiri', function () {
    Storage::fake('local');
    $owner = User::factory()->create(['role' => 'umkm']);
    $path = UploadedFile::fake()->create('d.pdf', 10)->store('dokumen_pengajuan', 'local');
    $pengajuan = Pengajuan::factory()->create(['user_id' => $owner->id, 'dokumen_pendukung' => $path]);

    $this->actingAs($owner)->get(route('pengajuan.dokumen', $pengajuan))->assertOk();
});

it('UMKM lain tidak dapat mengakses dokumen milik orang lain', function () {
    Storage::fake('local');
    $owner = User::factory()->create(['role' => 'umkm']);
    $other = User::factory()->create(['role' => 'umkm']);
    $path = UploadedFile::fake()->create('d.pdf', 10)->store('dokumen_pengajuan', 'local');
    $pengajuan = Pengajuan::factory()->create(['user_id' => $owner->id, 'dokumen_pendukung' => $path]);

    $this->actingAs($other)->get(route('pengajuan.dokumen', $pengajuan))->assertForbidden();
});

it('Petugas dinas dapat mengakses dokumen pengajuan manapun', function () {
    Storage::fake('local');
    $owner = User::factory()->create(['role' => 'umkm']);
    $dinas = User::factory()->create(['role' => 'dinas']);
    $path = UploadedFile::fake()->create('d.pdf', 10)->store('dokumen_pengajuan', 'local');
    $pengajuan = Pengajuan::factory()->create(['user_id' => $owner->id, 'dokumen_pendukung' => $path]);

    $this->actingAs($dinas)->get(route('pengajuan.dokumen', $pengajuan))->assertOk();
});
