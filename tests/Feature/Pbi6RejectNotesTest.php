<?php

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('PBI-6: menolak pengajuan tanpa catatan ditolak validasi', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $pengajuan = Pengajuan::factory()->create(['status' => 'pending']);

    $response = $this->actingAs($dinas)->put(route('dinas.pengajuan.reject', $pengajuan), [
        'notes' => '',
    ]);

    $response->assertSessionHasErrors('notes');
    expect($pengajuan->fresh()->status)->toBe('pending');
});

it('PBI-6: catatan tersimpan dan tampil ke UMKM', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm']);
    $pengajuan = Pengajuan::factory()->create(['user_id' => $umkm->id, 'status' => 'pending']);

    $this->actingAs($dinas)->put(route('dinas.pengajuan.reject', $pengajuan), [
        'notes' => 'Dokumen tidak lengkap.',
    ]);

    expect($pengajuan->fresh()->notes)->toBe('Dokumen tidak lengkap.');

    $this->actingAs($umkm)->get(route('umkm.pengajuan.index'))
        ->assertSee('Dokumen tidak lengkap.');
});
