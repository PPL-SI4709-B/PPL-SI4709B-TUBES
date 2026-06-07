<?php

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('PBI-5: approve mencatat reviewer dan waktu peninjauan', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $pengajuan = Pengajuan::factory()->create(['status' => 'pending']);

    $this->actingAs($dinas)->put(route('dinas.pengajuan.approve', $pengajuan), [
        'notes' => 'Disetujui.',
    ]);

    $pengajuan->refresh();
    expect($pengajuan->status)->toBe('approved');
    expect($pengajuan->reviewed_by)->toBe($dinas->id);
    expect($pengajuan->reviewed_at)->not->toBeNull();
});
