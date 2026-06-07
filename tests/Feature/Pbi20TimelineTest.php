<?php

use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('PBI-20: timeline pengajuan menampilkan tahap diajukan dan keputusan', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);
    Pengajuan::factory()->create([
        'user_id' => $umkm->id,
        'status' => 'approved',
        'reviewed_at' => now(),
    ]);

    $response = $this->actingAs($umkm)->get(route('umkm.pengajuan.index'));

    $response->assertOk();
    $response->assertSee('Diajukan');
    $response->assertSee('Disetujui');
});
