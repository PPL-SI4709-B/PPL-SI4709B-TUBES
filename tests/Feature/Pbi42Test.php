<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('PBI 42: umkm can access faq page when logged in', function () {
    $user = User::factory()->create(['role' => 'umkm']);

    $response = $this->actingAs($user)->get('/umkm/faq');

    $response->assertStatus(200);
    $response->assertViewIs('umkm.faq');
    $response->assertSee('FAQ & Bantuan');
});

test('PBI 42: faq page redirects to login when not authenticated', function () {
    $response = $this->get('/umkm/faq');
    $response->assertRedirect('/login');
});
