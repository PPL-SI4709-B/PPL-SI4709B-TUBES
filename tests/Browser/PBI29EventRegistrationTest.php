<?php

namespace Tests\Browser;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI29EventRegistrationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * TC.REG.001: Menguji fungsionalitas Pendaftaran Event (Positive)
     */
    public function test_positive_register_event()
    {
        $umkm = User::factory()->create(['role' => 'umkm']);
        $event = Event::create([
            'title' => 'Event Test Pendaftaran',
            'description' => 'Deskripsi event',
            'event_date' => '2026-01-01 10:00:00',
            'quota' => 10,
            'location' => 'Bandung',
            'type' => 'pelatihan',
            'status' => 'active',
        ]);

        $this->browse(function (Browser $browser) use ($umkm) {
            $browser->loginAs($umkm)
                ->visit('/umkm/event')
                ->assertSee('Event Test Pendaftaran')
                ->press('Daftar Sekarang')
                ->assertPathIs('/umkm/event')
                ->assertSee('Berhasil mendaftar ke event')
                ->assertSee('Sudah Terdaftar');
        });
    }

    /**
     * TC.REG.002: Menguji validasi Pendaftaran Event (Kuota Penuh) (Negative)
     */
    public function test_negative_register_event_full_quota()
    {
        $umkm = User::factory()->create(['role' => 'umkm']);
        
        $event = Event::create([
            'title' => 'Event Kuota Penuh',
            'description' => 'Deskripsi event',
            'event_date' => '2026-01-01 10:00:00',
            'quota' => 1,
            'location' => 'Bandung',
            'type' => 'pelatihan',
            'status' => 'active',
        ]);

        // Isi kuota dengan user lain agar kuota penuh
        $otherUser = User::factory()->create(['role' => 'umkm']);
        $event->registrants()->attach($otherUser->id, [
            'status' => 'registered',
        ]);

        $this->browse(function (Browser $browser) use ($umkm) {
            $browser->loginAs($umkm)
                ->visit('/umkm/event')
                ->assertSee('Event Kuota Penuh')
                // Memastikan tombol daftar berubah menjadi tombol "Penuh" yang disabled
                ->assertSee('Penuh')
                // Memastikan tombol "Daftar Sekarang" tidak muncul
                ->assertDontSee('Daftar Sekarang');
        });
    }
}
