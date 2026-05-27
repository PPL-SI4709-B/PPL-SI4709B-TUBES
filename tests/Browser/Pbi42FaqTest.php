<?php

use App\Models\User;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

uses(DatabaseMigrations::class);

/**
 * Positive Test Case: FAQ Page Display
 * Menguji apakah UMKM dapat melihat halaman FAQ & Bantuan.
 */
test('umkm can view faq page', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/login')
                ->type('email', 'test@umkm.local')
                ->type('password', 'password')
                ->press('Masuk ke Dashboard')
                ->assertPathIs('/umkm/dashboard')
                ->visit('/umkm/faq')
                ->assertSee('FAQ & Bantuan')
                ->assertSee('Kontak Dinas');
    });
});

/**
 * Negative Test Case: Unauthorized FAQ Access
 * Menguji apakah pengguna yang belum login tidak dapat mengakses halaman FAQ.
 */
test('guest cannot view faq page', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/umkm/faq')
                ->assertPathIs('/login')
                ->assertSee('Login');
    });
});
