<?php

use App\Models\Report;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('PBI-8: review laporan mencatat reviewer dan waktu', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $report = Report::factory()->create(['status' => 'pending']);

    $this->actingAs($dinas)->put(route('dinas.report.update', $report), [
        'status' => 'approved',
        'catatan_petugas' => 'Bagus.',
    ]);

    $report->refresh();
    expect($report->reviewed_by)->toBe($dinas->id);
    expect($report->reviewed_at)->not->toBeNull();
});
