<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('PBI 40: umkm can access notifikasi page when logged in', function () {
    $user = User::factory()->create(['role' => 'umkm']);

    $response = $this->actingAs($user)->get('/umkm/notifikasi');

    $response->assertStatus(200);
    $response->assertViewIs('umkm.notifikasi');
    $response->assertSee('Notifikasi & Riwayat Status');
});

test('PBI 40: notifikasi page redirects to login when not authenticated', function () {
    $response = $this->get('/umkm/notifikasi');
    $response->assertRedirect('/login');
});
