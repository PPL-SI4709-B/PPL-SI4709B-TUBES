<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Region;
use App\Models\Scale;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

/**
 * PBI #3 - Master Data Dasar UMKM - Referensi Profil UMKM
 *
 * Sebagai UMKM, saya ingin melihat data referensi kategori, wilayah,
 * dan skala usaha pada form profil, agar pengisian data usaha menjadi
 * lebih mudah dan valid.
 */
class PBI3ReferensiProfilUMKMTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * PBI ID    : PBI #3
     * Case ID   : TC.ReferensiProfil.001
     * Type      : Positive
     * Scenario  : UMKM login, membuka halaman edit profil, melihat dropdown
     *             kategori/wilayah/skala terisi data referensi dari database,
     *             memilih masing-masing, mengisi field wajib, lalu submit.
     *             Sistem menyimpan data dan menampilkan flash success.
     */
    public function test_positive_umkm_berhasil_melihat_dan_memilih_referensi_profil(): void
    {
        $umkm = User::factory()->create([
            'role' => 'umkm',
        ]);

        $category = Category::create(['name' => 'Kuliner', 'description' => 'Usaha kuliner']);
        $region   = Region::create(['name' => 'Kecamatan Cileunyi', 'description' => 'Wilayah Cileunyi']);
        $scale    = Scale::create(['name' => 'Mikro', 'description' => 'Skala mikro']);

        $this->browse(function (Browser $browser) use ($umkm, $category, $region, $scale) {
            $browser->loginAs($umkm)
                ->visit('/umkm/profile/edit')
                ->assertPresent('@profile-edit-form')
                // Pastikan dropdown referensi menampilkan data dari database
                ->assertSeeIn('@profile-category-select', 'Kuliner')
                ->assertSeeIn('@profile-region-select', 'Kecamatan Cileunyi')
                ->assertSeeIn('@profile-scale-select', 'Mikro')
                // Isi form dengan data valid
                ->type('@profile-business-name', 'Toko Rasa Nusantara')
                ->type('@profile-phone', '081234567890')
                ->type('@profile-nib', '1234567890123')
                ->select('@profile-category-select', $category->id)
                ->select('@profile-region-select', $region->id)
                ->select('@profile-scale-select', $scale->id)
                ->type('@profile-business-address', 'Jl. Raya Cileunyi No. 10')
                ->click('@profile-submit')
                ->assertPathIs('/umkm/profile')
                ->assertPresent('@flash-success')
                ->assertSeeIn('@flash-success', 'Profil usaha berhasil diperbarui.');
        });

        $this->assertDatabaseHas('umkm_profiles', [
            'user_id'     => $umkm->id,
            'category_id' => $category->id,
            'region_id'   => $region->id,
            'scale_id'    => $scale->id,
        ]);
    }

    /**
     * PBI ID    : PBI #3
     * Case ID   : TC.ReferensiProfil.002
     * Type      : Negative
     * Scenario  : UMKM login, membuka halaman edit profil, mengisi nama usaha
     *             dan alamat tetapi tidak memilih kategori, wilayah, dan skala
     *             (membiarkan default "-- Pilih --"). Submit form gagal dan
     *             sistem menampilkan pesan validation errors.
     */
    public function test_negative_umkm_gagal_menyimpan_profil_tanpa_referensi_wajib(): void
    {
        $umkm = User::factory()->create([
            'role' => 'umkm',
        ]);

        // Buat data referensi agar dropdown terisi (tapi user tidak memilih)
        Category::create(['name' => 'Fashion', 'description' => 'Usaha fashion']);
        Region::create(['name' => 'Kecamatan Bojongsoang', 'description' => 'Wilayah Bojongsoang']);
        Scale::create(['name' => 'Kecil', 'description' => 'Skala kecil']);

        $this->browse(function (Browser $browser) use ($umkm) {
            $browser->loginAs($umkm)
                ->visit('/umkm/profile/edit')
                ->assertPresent('@profile-edit-form')
                // Isi field wajib non-referensi
                ->type('@profile-business-name', 'Toko Test')
                ->type('@profile-business-address', 'Jl. Test No. 1')
                // Paksa select referensi ke value kosong via script
                // (karena HTML required bisa menahan submit)
                ->script([
                    "document.querySelector('[dusk=\"profile-category-select\"]').value = ''",
                    "document.querySelector('[dusk=\"profile-region-select\"]').value = ''",
                    "document.querySelector('[dusk=\"profile-scale-select\"]').value = ''",
                    "document.querySelector('[dusk=\"profile-category-select\"]').removeAttribute('required')",
                    "document.querySelector('[dusk=\"profile-region-select\"]').removeAttribute('required')",
                    "document.querySelector('[dusk=\"profile-scale-select\"]').removeAttribute('required')",
                ]);

            $browser->click('@profile-submit')
                ->assertPathIs('/umkm/profile/edit')
                ->assertPresent('@validation-errors');
        });
    }
}
