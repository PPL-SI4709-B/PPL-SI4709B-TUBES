<?php

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

function reportPayload(array $override = []): array
{
    return array_merge([
        'judul' => 'Laporan Juni',
        'deskripsi' => 'Perkembangan usaha bulan ini',
        'income' => 5000000,
        'expense' => 2000000,
        'report_date' => '2026-06-01',
        'period' => '2026-06',
        'due_date' => '2026-06-30',
    ], $override);
}

it('PBI-17: lampiran laporan disimpan di disk privat', function () {
    Storage::fake('local');
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'verified']);

    $this->actingAs($umkm)->post(route('reports.store'), reportPayload([
        'lampiran' => UploadedFile::fake()->create('bukti.pdf', 100, 'application/pdf'),
    ]));

    $report = Report::first();
    expect($report->lampiran)->not->toBeNull();
    Storage::disk('local')->assertExists($report->lampiran);
});

it('PBI-17: hanya pemilik atau dinas yang dapat mengunduh lampiran', function () {
    Storage::fake('local');
    $owner = User::factory()->create(['role' => 'umkm']);
    $other = User::factory()->create(['role' => 'umkm']);
    $dinas = User::factory()->create(['role' => 'dinas']);
    $path = UploadedFile::fake()->create('l.pdf', 10)->store('laporan', 'local');
    $report = Report::factory()->create(['user_id' => $owner->id, 'lampiran' => $path]);

    $this->actingAs($owner)->get(route('reports.lampiran', $report))->assertOk();
    $this->actingAs($other)->get(route('reports.lampiran', $report))->assertForbidden();
    $this->actingAs($dinas)->get(route('reports.lampiran', $report))->assertOk();
});
