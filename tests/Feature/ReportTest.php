<?php

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('UMKM dapat membuat laporan', function () {
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'verified']);

    $response = $this->actingAs($umkm)->post(route('reports.store'), [
        'judul' => 'Laporan Oktober 2024',
        'deskripsi' => 'Omzet bulan ini meningkat 15%',
        'income' => 10000000,
        'expense' => 4000000,
        'report_date' => '2024-10-01',
        'period' => 'Oktober 2024',
        'due_date' => '2024-10-31',
    ]);

    $response->assertRedirect(route('reports.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('reports', [
        'user_id' => $umkm->id,
        'judul' => 'Laporan Oktober 2024',
        'status' => 'pending',
    ]);
});

it('UMKM belum terverifikasi tidak dapat membuat laporan', function () {
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'pending']);

    $response = $this->actingAs($umkm)->post(route('reports.store'), [
        'judul' => 'Laporan',
        'deskripsi' => 'Isi laporan',
    ]);

    $response->assertSessionHas('error');
    $this->assertDatabaseMissing('reports', ['user_id' => $umkm->id]);
});

it('Laporan membutuhkan judul dan deskripsi', function () {
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'verified']);

    $response = $this->actingAs($umkm)->post(route('reports.store'), []);

    $response->assertSessionHasErrors(['judul', 'deskripsi']);
});

it('Petugas dapat menyetujui laporan', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm']);
    $report = Report::factory()->create(['user_id' => $umkm->id, 'status' => 'pending']);

    $response = $this->actingAs($dinas)->put(route('dinas.report.update', $report), [
        'status' => 'approved',
        'catatan_petugas' => 'Laporan valid.',
    ]);

    $response->assertRedirect(route('dinas.report.index'));

    $this->assertDatabaseHas('reports', [
        'id' => $report->id,
        'status' => 'approved',
    ]);
});
