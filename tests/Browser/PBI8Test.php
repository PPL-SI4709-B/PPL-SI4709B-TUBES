<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI8Test extends DuskTestCase
{
    /**
     * TC.REV.001 - Menguji akses halaman daftar laporan UMKM
     * User (Dinas) sudah login dan berada di Dashboard,
     * navigasi ke menu Daftar Laporan (URL: /dinas/report).
     * Halaman daftar laporan berhasil ditampilkan dan memuat list laporan masuk.
     */
    public function testAksesDaftarLaporan(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                    ->waitFor('input[name="email"]')
                    ->type('input[name="email"]', 'dinas@test.com')
                    ->type('input[name="password"]', 'password')
                    ->press('Masuk ke Dashboard')
                    ->waitForLocation('/dinas/pengajuan')
                    ->visit('/dinas/report')
                    ->assertPathIs('/dinas/report')
                    ->assertSee('Daftar Laporan');
        });
    }

    /**
     * TC.REV.002 - Menguji akses detail laporan UMKM
     * User (Dinas) berada di halaman Daftar Laporan,
     * klik tombol "Detail" pada salah satu laporan.
     * Halaman detail (URL: /dinas/report/{id}) terbuka menampilkan rincian laporan.
     */
    public function testAksesDetailLaporan(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                    ->waitFor('input[name="email"]')
                    ->type('input[name="email"]', 'dinas@test.com')
                    ->type('input[name="password"]', 'password')
                    ->press('Masuk ke Dashboard')
                    ->waitForLocation('/dinas/pengajuan')
                    ->visit('/dinas/report')
                    ->assertPathIs('/dinas/report')
                    ->clickLink('Detail')
                    ->assertPathContains('/dinas/report/')
                    ->assertSee('Detail Laporan');
        });
    }
}
