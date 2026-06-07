<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;

uses(DatabaseMigrations::class);

/**
 * Positive Test Case: Pengajuan Status Display
 * Menguji apakah UMKM dapat melihat status pengajuan mereka.
 */
test('umkm can view pengajuan status', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
            ->type('email', 'test@umkm.local')
            ->type('password', 'password')
            ->press('Masuk ke Dashboard')
            ->assertPathIs('/umkm/dashboard')
            ->visit('/umkm/pengajuan') // Halaman status pengajuan
            ->assertSee('Status Pengajuan'); // Harusnya ada teks terkait
    });
});

/**
 * Negative Test Case: Unauthorized Pengajuan Status Access
 * Menguji apakah pengguna yang belum login tidak dapat mengakses halaman status pengajuan.
 */
test('guest cannot view pengajuan status', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/umkm/pengajuan')
            ->assertPathIs('/login')
            ->assertSee('Login');
    });
});
