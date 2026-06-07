<?php

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('PBI-11: pencarian event memfilter berdasarkan judul', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);
    Event::factory()->create(['title' => 'Workshop Digital Marketing', 'status' => 'active']);
    Event::factory()->create(['title' => 'Pelatihan Akuntansi', 'status' => 'active']);

    $response = $this->actingAs($umkm)->get(route('umkm.event', ['search' => 'Digital']));

    $response->assertOk();
    $response->assertSee('Workshop Digital Marketing');
    $response->assertDontSee('Pelatihan Akuntansi');
});

it('PBI-11: filter jenis event menyaring hasil', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);
    Event::factory()->create(['title' => 'Acara Bootcamp', 'type' => 'bootcamp', 'status' => 'active']);
    Event::factory()->create(['title' => 'Acara Seminar', 'type' => 'seminar', 'status' => 'active']);

    $response = $this->actingAs($umkm)->get(route('umkm.event', ['type' => 'bootcamp']));

    $response->assertSee('Acara Bootcamp');
    $response->assertDontSee('Acara Seminar');
});
