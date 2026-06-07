<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;

uses(DatabaseMigrations::class);

/**
 * Positive Test Case: UMKM Profile Status Display
 * Menguji apakah UMKM dapat melihat status profil mereka.
 */
test('umkm can view profile status', function () {
    $this->browse(function (Browser $browser) {
        // Melakukan login via form karena Auth menggunakan dummy session
        $browser->visit('/login')
            ->type('email', 'test@umkm.local')
            ->type('password', 'password')
            ->press('Masuk ke Dashboard')
            ->assertPathIs('/umkm/dashboard')
                // Mengecek notifikasi/badge status profil di dashboard UMKM
            ->assertSee('Profil Anda belum diverifikasi');
    });
});

/**
 * Negative Test Case: Unauthorized Profile Access
 * Menguji apakah pengguna yang tidak login dialihkan saat mencoba mengakses.
 */
test('guest cannot view profile status', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/umkm/dashboard')
            ->assertPathIs('/login')
            ->assertSee('Login');
    });
});
