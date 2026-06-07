<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('Petugas dapat memverifikasi UMKM', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'pending']);

    $response = $this->actingAs($dinas)
        ->put(route('dinas.verification.verify', $umkm));

    $response->assertRedirect(route('dinas.verification.index'));
    $response->assertSessionHas('success');

    $this->assertDatabaseHas('users', [
        'id' => $umkm->id,
        'profile_status' => 'verified',
    ]);
});

it('Petugas dapat menolak verifikasi UMKM', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $umkm = User::factory()->create(['role' => 'umkm', 'profile_status' => 'pending']);

    $response = $this->actingAs($dinas)
        ->put(route('dinas.verification.reject', $umkm));

    $response->assertRedirect(route('dinas.verification.index'));

    $this->assertDatabaseHas('users', [
        'id' => $umkm->id,
        'profile_status' => 'rejected',
    ]);
});

it('UMKM tidak bisa mengakses halaman verifikasi', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);

    $response = $this->actingAs($umkm)->get(route('dinas.verification.index'));
    $response->assertForbidden();
});
