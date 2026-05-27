<?php

use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

/**
 * Positive Test Case: Notifikasi & Riwayat Status Display
 * Menguji apakah UMKM dapat melihat halaman notifikasi mereka.
 */
test('umkm can view notifikasi page', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
                ->type('email', 'test@umkm.local')
                ->type('password', 'password')
                ->press('Masuk ke Dashboard')
                ->assertPathIs('/umkm/dashboard')
                ->visit('/umkm/notifikasi')
                ->assertSee('Semua Notifikasi')
                ->assertSee('Riwayat Perubahan Status');
    });
});

/**
 * Negative Test Case: Unauthorized Notifikasi Access
 * Menguji apakah pengguna yang belum login tidak dapat mengakses halaman notifikasi.
 */
test('guest cannot view notifikasi page', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/umkm/notifikasi')
                ->assertPathIs('/login')
                ->assertSee('Login');
    });
});
