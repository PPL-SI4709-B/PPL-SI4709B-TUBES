<?php

use App\Models\PengajuanStatusLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('PBI 41: can create pengajuan status log', function () {
    $user = User::factory()->create();
    
    $log = PengajuanStatusLog::create([
        'pengajuan_id' => 1,
        'status' => 'pending',
        'catatan' => 'Berkas sedang diverifikasi',
        'created_by' => $user->id
    ]);
    
    expect($log->status)->toBe('pending');
    expect($log->catatan)->toBe('Berkas sedang diverifikasi');
    expect($log->user->id)->toBe($user->id);
    
    $this->assertDatabaseHas('pengajuan_status_logs', [
        'status' => 'pending',
        'catatan' => 'Berkas sedang diverifikasi'
    ]);
});
