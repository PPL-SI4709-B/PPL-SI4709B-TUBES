<?php

namespace Tests\Browser;

use App\Models\Region;
use App\Models\Scale;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * PBI #2 - Master Data Dasar UMKM - Mengelola Data Wilayah dan Skala Usaha
 *
 * Sebagai Petugas Dinas, saya ingin mengelola data wilayah dan skala usaha,
 * agar data profil UMKM dapat dicatat secara lengkap dan seragam.
 */
class PBI2WilayahSkalaUsahaTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * PBI ID    : PBI #2
     * Case ID   : TC.WilayahSkala.001
     * Type      : Positive
     * Scenario  : Petugas Dinas mengakses halaman wilayah, menambahkan wilayah baru
     *             yang valid, lalu mengakses halaman skala usaha dan menambahkan
     *             skala usaha baru yang valid. Sistem menyimpan kedua data dan
     *             menampilkan flash success masing-masing.
     */
    public function test_positive_petugas_dinas_berhasil_menambahkan_wilayah_dan_skala_usaha_baru(): void
    {
        $dinas = User::factory()->create([
            'role' => 'dinas',
        ]);

        $this->browse(function (Browser $browser) use ($dinas) {
            // --- Tambah Wilayah ---
            $browser->loginAs($dinas)
                ->visit('/dinas/region')
                ->assertPresent('@region-index')
                ->click('@region-create-link')
                ->assertPathIs('/dinas/region/create')
                ->assertPresent('@region-form')
                ->type('@region-name', 'Kecamatan Cileunyi')
                ->type('@region-description', 'Wilayah Kecamatan Cileunyi Kabupaten Bandung')
                ->click('@region-submit')
                ->assertPathIs('/dinas/region')
                ->assertPresent('@flash-success')
                ->assertSeeIn('@flash-success', 'Wilayah berhasil ditambahkan.');

            // --- Tambah Skala Usaha ---
            $browser->visit('/dinas/scale')
                ->assertPresent('@scale-index')
                ->click('@scale-create-link')
                ->assertPathIs('/dinas/scale/create')
                ->assertPresent('@scale-form')
                ->type('@scale-name', 'Mikro')
                ->type('@scale-description', 'Usaha dengan omzet di bawah Rp 300 juta per tahun')
                ->click('@scale-submit')
                ->assertPathIs('/dinas/scale')
                ->assertPresent('@flash-success')
                ->assertSeeIn('@flash-success', 'Skala usaha berhasil ditambahkan.');
        });

        $this->assertDatabaseHas('regions', [
            'name' => 'Kecamatan Cileunyi',
        ]);

        $this->assertDatabaseHas('scales', [
            'name' => 'Mikro',
        ]);
    }

    /**
     * PBI ID    : PBI #2
     * Case ID   : TC.WilayahSkala.002
     * Type      : Negative
     * Scenario  : Petugas Dinas mencoba menambahkan wilayah dengan nama yang sudah
     *             ada, lalu mencoba menambahkan skala usaha dengan nama yang sudah
     *             ada. Sistem menolak keduanya dan menampilkan pesan validasi
     *             "Nama wilayah sudah ada." dan "Nama skala usaha sudah ada."
     */
    public function test_negative_petugas_dinas_gagal_menambahkan_wilayah_dan_skala_usaha_duplikat(): void
    {
        $dinas = User::factory()->create([
            'role' => 'dinas',
        ]);

        // Buat data awal agar terjadi duplikat
        Region::create([
            'name' => 'Kecamatan Bojongsoang',
            'description' => 'Wilayah yang sudah ada',
        ]);

        Scale::create([
            'name' => 'Kecil',
            'description' => 'Skala usaha yang sudah ada',
        ]);

        $this->browse(function (Browser $browser) use ($dinas) {
            // --- Duplikat Wilayah ---
            $browser->loginAs($dinas)
                ->visit('/dinas/region/create')
                ->assertPresent('@region-form')
                ->type('@region-name', 'Kecamatan Bojongsoang')
                ->type('@region-description', 'Wilayah duplikat')
                ->click('@region-submit')
                ->assertPathIs('/dinas/region/create')
                ->assertPresent('@error-name')
                ->assertSeeIn('@error-name', 'Nama wilayah sudah ada.');

            // --- Duplikat Skala Usaha ---
            $browser->visit('/dinas/scale/create')
                ->assertPresent('@scale-form')
                ->type('@scale-name', 'Kecil')
                ->type('@scale-description', 'Skala usaha duplikat')
                ->click('@scale-submit')
                ->assertPathIs('/dinas/scale/create')
                ->assertPresent('@error-name')
                ->assertSeeIn('@error-name', 'Nama skala usaha sudah ada.');
        });
    }
}
