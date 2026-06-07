<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('PBI 21: umkm dashboard requires login', function () {
    $response = $this->get('/umkm/dashboard');
    $response->assertRedirect('/login');
});

test('PBI 21: umkm dashboard can be accessed when logged in', function () {
    $user = User::factory()->create(['role' => 'umkm', 'profile_status' => 'verified']);

    $response = $this->actingAs($user)->get('/umkm/dashboard');

    $response->assertStatus(200);
    $response->assertViewIs('umkm.dashboard');
});

test('PBI 21: dinas dashboard is accessible', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);

    $response = $this->actingAs($dinas)->get('/dinas/dashboard');

    $response->assertStatus(200);
    $response->assertViewIs('dinas.dashboard');
});
