<?php

use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('PBI-4: Petugas dapat melihat halaman detail program', function () {
    $dinas = User::factory()->create(['role' => 'dinas']);
    $program = Program::factory()->create(['name' => 'Program Inkubasi Digital']);

    $response = $this->actingAs($dinas)->get(route('dinas.program.show', $program));

    $response->assertOk();
    $response->assertSee('Program Inkubasi Digital');
});

it('PBI-4: UMKM tidak dapat mengakses detail program dinas', function () {
    $umkm = User::factory()->create(['role' => 'umkm']);
    $program = Program::factory()->create();

    $this->actingAs($umkm)->get(route('dinas.program.show', $program))->assertForbidden();
});
