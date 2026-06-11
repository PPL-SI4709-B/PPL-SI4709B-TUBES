<?php

namespace Tests\Browser;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI28EventCrudTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * TC.EVE.001: Menguji fungsionalitas Create Event (Positive)
     */
    public function test_positive_create_event()
    {
        $dinas = User::factory()->create(['role' => 'dinas']);

        $this->browse(function (Browser $browser) use ($dinas) {
            $browser->loginAs($dinas)
                ->visit('/dinas/event')
                ->clickLink('+ Tambah Event')
                ->assertPathIs('/dinas/event/create')
                ->type('title', 'Pelatihan Digital Marketing')
                ->type('description', 'Deskripsi pelatihan')
                ->script("document.querySelector('input[name=event_date]').value = '2025-12-12T10:00'");
            
            $browser->type('quota', '50')
                ->type('location', 'Gedung Sabilulungan')
                ->select('type', 'pelatihan')
                ->select('status', 'active')
                ->press('Simpan Event')
                ->assertPathIs('/dinas/event')
                ->assertSee('Event berhasil ditambahkan.')
                ->assertSee('Pelatihan Digital Marketing');
        });
    }

    /**
     * TC.EVE.002: Menguji validasi form Create Event (Kosong) (Negative)
     */
    public function test_negative_create_event_empty_fields()
    {
        $dinas = User::factory()->create(['role' => 'dinas']);

        $this->browse(function (Browser $browser) use ($dinas) {
            $browser->loginAs($dinas)
                ->visit('/dinas/event/create')
                ->press('Simpan Event')
                ->assertPathIs('/dinas/event/create')
                // Mengecek apakah sistem menolak penyimpanan karena ada validasi
                ->assertPathIs('/dinas/event/create');
        });
    }

    /**
     * TC.EVE.003: Menguji fungsionalitas Update Event (Positive)
     */
    public function test_positive_update_event()
    {
        $dinas = User::factory()->create(['role' => 'dinas']);
        $event = Event::create([
            'title' => 'Event Lama',
            'description' => 'Deskripsi lama',
            'event_date' => '2025-01-01 10:00:00',
            'quota' => 10,
            'location' => 'Lokasi Lama',
            'type' => 'seminar',
            'status' => 'inactive',
        ]);

        $this->browse(function (Browser $browser) use ($dinas, $event) {
            $browser->loginAs($dinas)
                ->visit('/dinas/event')
                ->assertSee('Event Lama')
                ->clickLink('Edit')
                ->assertPathIs('/dinas/event/' . $event->id . '/edit')
                ->type('title', 'Event Diperbarui')
                ->press('Simpan Perubahan')
                ->assertPathIs('/dinas/event')
                ->assertSee('Event berhasil diperbarui.')
                ->assertSee('Event Diperbarui');
        });
    }

    /**
     * TC.EVE.004: Menguji fungsionalitas Delete Event (Positive)
     */
    public function test_positive_delete_event()
    {
        $dinas = User::factory()->create(['role' => 'dinas']);
        $event = Event::create([
            'title' => 'Event Untuk Dihapus',
            'description' => 'Deskripsi',
            'event_date' => '2025-01-01 10:00:00',
            'quota' => 10,
            'location' => 'Lokasi',
            'type' => 'seminar',
            'status' => 'inactive',
        ]);

        $this->browse(function (Browser $browser) use ($dinas, $event) {
            $browser->loginAs($dinas)
                ->visit('/dinas/event')
                ->assertSee('Event Untuk Dihapus')
                ->press('Hapus')
                ->acceptDialog()
                ->assertPathIs('/dinas/event')
                ->assertSee('Event berhasil dihapus.')
                ->assertDontSee('Event Untuk Dihapus');
        });
    }
}
