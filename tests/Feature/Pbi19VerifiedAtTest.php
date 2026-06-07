<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('PBI-19: verifikasi mencatat waktu diproses (riwayat)', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'pending']);

    $this->actingAs($dinas)->put(route('dinas.verification.verify', $umkm));

    expect($umkm->fresh()->verified_at)->not->toBeNull();
});

it('PBI-19: alasan penolakan dan waktu tampil di profil UMKM', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'pending']);

    $this->actingAs($dinas)->put(route('dinas.verification.reject', $umkm), [
        'verification_note' => 'NIB tidak valid.',
    ]);

    $this->actingAs($umkm->fresh())->get(route('umkm.profile.show'))
        ->assertSee('NIB tidak valid.');
});
