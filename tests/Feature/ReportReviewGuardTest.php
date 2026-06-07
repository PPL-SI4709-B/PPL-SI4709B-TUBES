<?php

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('Laporan yang sudah direview tidak dapat direview ulang', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm']);
    $report = Report::factory()->create(['user_id' => $umkm->id, 'status' => 'approved']);

    $response = $this->actingAs($dinas)->put(route('dinas.report.update', $report), [
        'status' => 'rejected',
        'catatan_petugas' => 'Coba ubah ulang.',
    ]);

    $response->assertSessionHas('error');
    $this->assertDatabaseHas('reports', ['id' => $report->id, 'status' => 'approved']);
});

it('Petugas menyimpan alasan saat menolak verifikasi UMKM', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'pending']);

    $this->actingAs($dinas)->put(route('dinas.verification.reject', $umkm), [
        'verification_note' => 'Dokumen tidak lengkap.',
    ]);

    $this->assertDatabaseHas('users', [
        'id' => $umkm->id,
        'profile_status' => 'rejected',
        'verification_note' => 'Dokumen tidak lengkap.',
    ]);
});
