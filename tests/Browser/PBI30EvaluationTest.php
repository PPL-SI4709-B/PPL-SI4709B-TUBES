<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI30EvaluationTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * TC.EVAL.001: Menguji fungsionalitas Evaluasi Laporan (Positive)
     */
    public function test_positive_submit_evaluation()
    {
        $dinas = User::factory()->create(['role' => 'dinas']);
        $reportId = 1; // EvaluasiController menggunakan mock report saat ini

        $this->browse(function (Browser $browser) use ($dinas, $reportId) {
            $browser->loginAs($dinas)
                ->visit('/dinas/report/' . $reportId . '/evaluate')
                ->assertSee('Evaluasi Laporan')
                ->radio('score', '4')
                ->type('notes', 'Laporan sudah cukup baik, lanjutkan perkembangannya.')
                ->select('status', 'passed')
                ->press('Simpan Evaluasi')
                ->assertPathIs('/dinas/report')
                ->assertSee('Evaluasi laporan berhasil disimpan.');
        });
    }

    /**
     * TC.EVAL.002: Menguji validasi form Evaluasi (Kosong) (Negative)
     */
    public function test_negative_submit_evaluation_empty()
    {
        $dinas = User::factory()->create(['role' => 'dinas']);
        $reportId = 2; 

        $this->browse(function (Browser $browser) use ($dinas, $reportId) {
            $browser->loginAs($dinas)
                ->visit('/dinas/report/' . $reportId . '/evaluate')
                // Sengaja tidak mengisi form
                ->press('Simpan Evaluasi')
                // Memastikan sistem menolak dan user masih tetap di halaman yang sama
                ->assertPathIs('/dinas/report/' . $reportId . '/evaluate');
        });
    }
}
