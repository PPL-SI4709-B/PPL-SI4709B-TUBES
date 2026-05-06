<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;
use App\Models\Pengajuan;

class PBI15StatusViewTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Positive: Berhasil melihat status pengajuan yang telah dibuat
     */
    public function test_positive_view_status_pengajuan()
    {
        $user = User::factory()->create(['role' => 'umkm']);
        
        Pengajuan::create([
            'user_id' => $user->id,
            'program_name' => 'Pendampingan Akses Layanan Pembiayaan',
            'kebutuhan_usaha' => 'Kebutuhan test status',
            'status' => 'pending'
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit('/umkm/pengajuan')
                    ->assertSee('Kebutuhan test status')
                    ->assertSee('MENUNGGU'); // Badges display 'Menunggu' for 'pending' (rendered as MENUNGGU by css)
        });
    }

    /**
     * Test Negative: Gagal mengakses halaman status karena belum login
     */
    public function test_negative_view_status_unauthorized()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/umkm/pengajuan')
                    ->assertPathIs('/login'); // Assuming unauthenticated users redirect to login
        });
    }
}
