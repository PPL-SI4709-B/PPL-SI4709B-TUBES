<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('PBI 21: umkm dashboard requires login', function () {
    $response = $this->get('/umkm/dashboard');
    $response->assertRedirect('/login');
});

test('PBI 21: umkm dashboard can be accessed when logged in', function () {
    session(['is_logged_in' => true]);
    $response = $this->get('/umkm/dashboard');
    $response->assertStatus(200);
    $response->assertViewIs('umkm.dashboard');
});

test('PBI 21: dinas dashboard is accessible', function () {
    $response = $this->get('/dinas/dashboard');
    $response->assertStatus(200);
    $response->assertViewIs('dinas.dashboard');
});
