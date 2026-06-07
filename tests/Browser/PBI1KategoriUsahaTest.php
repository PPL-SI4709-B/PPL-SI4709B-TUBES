<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * PBI #1 - Master Data Dasar UMKM - Mengelola Data Kategori Usaha
 *
 * Sebagai Petugas Dinas, saya ingin mengelola data kategori usaha,
 * agar data UMKM dapat diklasifikasikan secara terstandarisasi.
 */
class PBI1KategoriUsahaTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * PBI ID    : PBI #1
     * Case ID   : TC.KategoriUsaha.001
     * Type      : Positive
     * Scenario  : Petugas Dinas mengakses halaman index kategori,
     *             klik tombol Tambah Kategori, mengisi nama dan deskripsi
     *             yang valid, lalu submit. Sistem menyimpan data dan
     *             menampilkan flash success "Kategori usaha berhasil ditambahkan."
     */
    public function test_positive_petugas_dinas_berhasil_menambahkan_kategori_usaha_baru(): void
    {
        $dinas = User::factory()->create([
            'role' => 'dinas',
        ]);

        $this->browse(function (Browser $browser) use ($dinas) {
            $browser->loginAs($dinas)
                ->visit('/dinas/category')
                ->assertPresent('@category-index')
                ->click('@category-create-link')
                ->assertPathIs('/dinas/category/create')
                ->assertPresent('@category-form')
                ->type('@category-name', 'Kuliner Nusantara')
                ->type('@category-description', 'Kategori untuk usaha bidang kuliner dan makanan')
                ->click('@category-submit')
                ->assertPathIs('/dinas/category')
                ->assertPresent('@flash-success')
                ->assertSeeIn('@flash-success', 'Kategori usaha berhasil ditambahkan.');
        });

        $this->assertDatabaseHas('categories', [
            'name' => 'Kuliner Nusantara',
        ]);
    }

    /**
     * PBI ID    : PBI #1
     * Case ID   : TC.KategoriUsaha.002
     * Type      : Negative
     * Scenario  : Petugas Dinas mencoba menambahkan kategori dengan nama
     *             yang sudah ada di database. Sistem menolak dan menampilkan
     *             pesan validasi "Nama kategori sudah ada." pada field name.
     */
    public function test_negative_petugas_dinas_gagal_menambahkan_kategori_usaha_duplikat(): void
    {
        $dinas = User::factory()->create([
            'role' => 'dinas',
        ]);

        // Buat kategori awal agar terjadi duplikat saat submit
        Category::create([
            'name' => 'Fashion',
            'description' => 'Kategori fashion yang sudah ada',
        ]);

        $this->browse(function (Browser $browser) use ($dinas) {
            $browser->loginAs($dinas)
                ->visit('/dinas/category/create')
                ->assertPresent('@category-form')
                ->type('@category-name', 'Fashion')
                ->type('@category-description', 'Kategori fashion duplikat')
                ->click('@category-submit')
                ->assertPathIs('/dinas/category/create')
                ->assertPresent('@error-name')
                ->assertSeeIn('@error-name', 'Nama kategori sudah ada.');
        });
    }
}
