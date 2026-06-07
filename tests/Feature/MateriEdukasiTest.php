<?php

use App\Models\MateriEdukasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('UMKM dapat melihat daftar materi edukasi', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);
    MateriEdukasi::factory()->count(3)->create();

    $response = $this->actingAs($umkm)->get(route('umkm.materi-edukasi.index'));

    $response->assertStatus(200);
    $response->assertViewIs('umkm.materi-edukasi.index');
});

it('UMKM dapat melihat detail materi edukasi', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);
    $materi = MateriEdukasi::factory()->create();

    $response = $this->actingAs($umkm)->get(route('umkm.materi-edukasi.show', $materi));

    $response->assertStatus(200);
    $response->assertViewIs('umkm.materi-edukasi.show');
    $response->assertSee($materi->title);
});

it('daftar materi edukasi butuh login', function () {
    $response = $this->get(route('umkm.materi-edukasi.index'));
    $response->assertRedirect(route('login'));
});
