<?php

use App\Models\UmkmProfile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('petugas dinas dapat export rekap data UMKM', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create([
        'name' => 'Sari Mandiri',
        'email' => 'sari@example.com',
        'role' => 'umkm',
        'profile_status' => 'verified',
    ]);

    UmkmProfile::create([
        'user_id' => $umkm->id,
        'business_name' => 'Warung Sari',
        'phone' => '08123456789',
        'nib' => '1234567890',
        'business_address' => 'Kabupaten Bandung',
    ]);

    $response = $this->actingAs($dinas)->get(route('dinas.dashboard.export-umkm'));

    $response->assertOk();
    $response->assertHeader('content-type', 'text/csv; charset=UTF-8');

    expect($response->streamedContent())
        ->toContain('Nama Pemilik')
        ->toContain('Sari Mandiri')
        ->toContain('Warung Sari');
});
