<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PBI14UploadDocTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Positive: Berhasil mengunggah dokumen dengan format sesuai
     */
    public function test_positive_upload_dokumen()
    {
        $user = User::factory()->create(['role' => 'umkm']);

        $filePath = storage_path('app/public/dummy.pdf');
        if (! file_exists(storage_path('app/public'))) {
            mkdir(storage_path('app/public'), 0777, true);
        }
        // Create a minimal valid PDF content to pass the mimes validation
        $pdfContent = "%PDF-1.4\n%\xE2\xE3\xCF\xD3\n1 0 obj\n<< /Type /Catalog >>\nendobj\ntrailer\n<< /Root 1 0 R >>\n%%EOF";
        file_put_contents($filePath, $pdfContent);

        $this->browse(function (Browser $browser) use ($user, $filePath) {
            $browser->loginAs($user)
                ->visit('/umkm/pengajuan')
                ->press('Ajukan Program')
                ->waitFor('#modal-pengajuan')
                ->type('kebutuhan_usaha', 'Butuh mesin jahit baru')
                ->attach('dokumen_pendukung', $filePath)
                ->press('Kirim Pengajuan')
                ->waitForText('Berhasil!', 5)
                ->assertSee('Berhasil!');
        });
    }

    /**
     * Test Negative: Gagal mengunggah dokumen karena format tidak sesuai
     */
    public function test_negative_upload_dokumen_invalid()
    {
        $user = User::factory()->create(['role' => 'umkm']);

        $filePath = storage_path('app/public/dummy.txt');
        if (! file_exists(storage_path('app/public'))) {
            mkdir(storage_path('app/public'), 0777, true);
        }
        file_put_contents($filePath, 'dummy text content');

        $this->browse(function (Browser $browser) use ($user, $filePath) {
            $browser->loginAs($user)
                ->visit('/umkm/pengajuan')
                ->press('Ajukan Program')
                ->waitFor('#modal-pengajuan')
                ->type('kebutuhan_usaha', 'Butuh mesin jahit baru')
                ->attach('dokumen_pendukung', $filePath)
                ->press('Kirim Pengajuan')
                ->pause(1000)
                ->assertDontSee('Berhasil!');
        });
    }
}
