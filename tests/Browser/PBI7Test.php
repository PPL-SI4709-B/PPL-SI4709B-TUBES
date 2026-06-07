<?php

namespace Tests\Browser;

use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI7Test extends DuskTestCase
{
    use DatabaseMigrations;

    protected function seedData()
    {
        $user = User::factory()->create([
            'email' => 'umkm@test.com',
        ]);

        $program = Program::create([
            'name' => 'Program Bantuan UMKM',
            'quota' => 100,
            'status' => 'active',
        ]);

        Pengajuan::create([
            'user_id' => $user->id,
            'program_id' => $program->id,
            'status' => 'pending',
        ]);
    }

    /**
     * TC.VRF.001 - fungsionalitas Verifikasi UMKM (Approve)
     */
    public function test_approve_umkm(): void
    {
        $this->seedData();
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitFor('input[name="email"]')
                ->type('input[name="email"]', 'dinas@test.com')
                ->type('input[name="password"]', 'password')
                ->press('Masuk ke Dashboard')
                ->waitForLocation('/dinas/pengajuan')
                ->assertSee('Approval Pengajuan')
                ->clickLink('Detail')
                ->assertSee('Detail Pengajuan')
                ->press('Setujui')
                ->acceptDialog()
                ->assertPathIs('/dinas/pengajuan')
                ->assertSee('Pengajuan berhasil disetujui.');
        });
    }

    /**
     * TC.VRF.002 - fungsionalitas Verifikasi UMKM (Reject)
     */
    public function test_reject_umkm(): void
    {
        $this->seedData();
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->waitFor('input[name="email"]')
                ->type('input[name="email"]', 'dinas@test.com')
                ->type('input[name="password"]', 'password')
                ->press('Masuk ke Dashboard')
                ->waitForLocation('/dinas/pengajuan')
                ->assertSee('Approval Pengajuan')
                ->clickLink('Detail')
                ->assertSee('Detail Pengajuan')
                ->press('Tolak')
                ->acceptDialog()
                ->assertPathIs('/dinas/pengajuan')
                ->assertSee('Pengajuan berhasil ditolak.');
        });
    }
}
