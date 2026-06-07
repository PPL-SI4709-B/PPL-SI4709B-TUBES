<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI9Test extends DuskTestCase
{
    /**
     * TC.RPS.001 - Menguji Update Status Laporan menjadi Approved
     * User (Dinas) berada di halaman Detail Laporan,
     * pilih opsi "approved" pada input pilihan status,
     * klik tombol Simpan/Update.
     * Status laporan tersimpan, sistem redirect ke index dengan pesan "Status laporan berhasil diupdate."
     */
    public function test_update_status_approved(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitFor('input[name="email"]')
                ->type('input[name="email"]', 'dinas@test.com')
                ->type('input[name="password"]', 'password')
                ->press('Masuk ke Dashboard')
                ->waitForLocation('/dinas/pengajuan')
                ->visit('/dinas/report/1')
                ->assertSee('Detail Laporan')
                ->select('status', 'approved')
                ->press('Simpan/Update')
                ->assertPathIs('/dinas/report')
                ->assertSee('Status laporan berhasil diupdate.');
        });
    }

    /**
     * TC.RPS.002 - Menguji Update Status Laporan menjadi Rejected
     * User (Dinas) berada di halaman Detail Laporan,
     * pilih opsi "rejected" pada input pilihan status,
     * isi alasan penolakan pada field feedback,
     * klik tombol Simpan/Update.
     * Status laporan tersimpan, sistem redirect ke index dengan pesan "Status laporan berhasil diupdate."
     */
    public function test_update_status_rejected(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitFor('input[name="email"]')
                ->type('input[name="email"]', 'dinas@test.com')
                ->type('input[name="password"]', 'password')
                ->press('Masuk ke Dashboard')
                ->waitForLocation('/dinas/pengajuan')
                ->visit('/dinas/report/1')
                ->assertSee('Detail Laporan')
                ->select('status', 'rejected')
                ->type('feedback', 'Alasan penolakan contoh')
                ->press('Simpan/Update')
                ->assertPathIs('/dinas/report')
                ->assertSee('Status laporan berhasil diupdate.');
        });
    }

    /**
     * TC.RPS.003 - Menguji validasi form Update Status (Kosong)
     * User (Dinas) berada di halaman Detail Laporan,
     * kosongkan pilihan status laporan pada dropdown,
     * langsung klik tombol Simpan/Update.
     * Sistem mencegah update dan memunculkan error validasi required pada status.
     */
    public function test_validasi_update_status_kosong(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitFor('input[name="email"]')
                ->type('input[name="email"]', 'dinas@test.com')
                ->type('input[name="password"]', 'password')
                ->press('Masuk ke Dashboard')
                ->waitForLocation('/dinas/pengajuan')
                ->visit('/dinas/report/1')
                ->assertSee('Detail Laporan')
                ->select('status', '') // Mengosongkan dropdown
                ->press('Simpan/Update')
                ->assertPathIs('/dinas/report/1')
                ->assertSee('The status field is required.'); // Sesuaikan teks error ini dengan message validasi Laravel kamu
        });
    }
}
