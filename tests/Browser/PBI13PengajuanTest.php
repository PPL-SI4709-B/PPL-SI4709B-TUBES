<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI13PengajuanTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Positive: Berhasil melakukan pengajuan program
     */
    public function test_positive_pengajuan_berhasil()
    {
        $user = User::factory()->create([
            'role' => 'umkm',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/umkm/pengajuan')
                ->press('Ajukan Program')
                ->waitFor('#modal-pengajuan')
                ->type('kebutuhan_usaha', 'Butuh pinjaman untuk ekspansi')
                ->press('Kirim Pengajuan')
                ->waitForText('Berhasil!', 5)
                ->assertSee('Berhasil!');
        });
    }

    /**
     * Test Negative: Gagal melakukan pengajuan karena data tidak lengkap
     */
    public function test_negative_pengajuan_tanpa_kebutuhan()
    {
        $user = User::factory()->create([
            'role' => 'umkm',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/umkm/pengajuan')
                ->press('Ajukan Program')
                ->waitFor('#modal-pengajuan')
                ->script("document.getElementById('kebutuhan_usaha').removeAttribute('required');");

            $browser->press('Kirim Pengajuan')
                ->pause(1000)
                ->assertDontSee('Berhasil!')
                ->assertPathIs('/umkm/pengajuan');
        });
    }
}
