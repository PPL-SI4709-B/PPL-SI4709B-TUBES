<?php

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('Petugas dapat menyetujui pengajuan yang pending', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $pengajuan = Pengajuan::factory()->create(['status' => 'pending']);

    $response = $this->actingAs($dinas)->put(route('dinas.pengajuan.approve', $pengajuan), [
        'notes' => 'Disetujui.',
    ]);

    $response->assertRedirect(route('dinas.pengajuan.index'));
    $this->assertDatabaseHas('pengajuans', ['id' => $pengajuan->id, 'status' => 'approved']);
});

it('Pengajuan yang sudah diproses tidak dapat diproses ulang', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $pengajuan = Pengajuan::factory()->create(['status' => 'approved']);

    $response = $this->actingAs($dinas)->put(route('dinas.pengajuan.reject', $pengajuan), [
        'notes' => 'Coba tolak ulang.',
    ]);

    $response->assertSessionHas('error');
    $this->assertDatabaseHas('pengajuans', ['id' => $pengajuan->id, 'status' => 'approved']);
});
