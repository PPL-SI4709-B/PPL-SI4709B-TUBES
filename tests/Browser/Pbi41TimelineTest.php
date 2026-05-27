<?php

use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

/**
 * Positive Test Case: Timeline Status Display
 * Menguji apakah UMKM dapat melihat timeline perubahan status pengajuan mereka.
 */
test('umkm can view timeline status pengajuan', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
                ->type('email', 'test@umkm.local')
                ->type('password', 'password')
                ->press('Masuk ke Dashboard')
                ->assertPathIs('/umkm/dashboard')
                ->visit('/umkm/pengajuan/timeline')
                ->assertSee('Timeline Perubahan Status Pengajuan');
    });
});

/**
 * Negative Test Case: Unauthorized Timeline Access
 * Menguji apakah pengguna yang belum login tidak dapat mengakses timeline.
 */
test('guest cannot view timeline status pengajuan', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/umkm/pengajuan/timeline')
                ->assertPathIs('/login')
                ->assertSee('Login');
    });
});
