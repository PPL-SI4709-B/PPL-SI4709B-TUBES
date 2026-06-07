<?php

use App\Models\Pengajuan;
use App\Models\Program;
use App\Models\User;
use Laravel\Dusk\Browser;

test('PBI#4 - dinas dapat membuat program baru', function () {
    $dinas = User::factory()->create([
        'role' => 'dinas',
        'password' => bcrypt('password'),
    ]);

    $this->browse(function (Browser $browser) use ($dinas) {
        $browser->loginAs($dinas)
            ->visit('/dinas/program/create')
            ->assertSee('Tambah Program')
            ->select('jenis', 'pendanaan')
            ->type('name', 'Program Bantuan Digitalisasi')
            ->type('description', 'Deskripsi program digitalisasi UMKM.')
            ->type('quota', '50')
            ->type('start_date', '2026-06-01')
            ->type('end_date', '2026-09-01')
            ->select('status', 'active')
            ->press('Simpan Program')
            ->waitForText('berhasil')
            ->assertSee('berhasil')
            ->assertSee('Program Bantuan Digitalisasi');
    });
});

test('PBI#4 - dinas dapat mengedit program', function () {
    $dinas = User::factory()->create([
        'role' => 'dinas',
        'password' => bcrypt('password'),
    ]);

    $program = Program::factory()->create([
        'name' => 'Program Lama',
        'jenis' => 'pembinaan',
        'status' => 'active',
    ]);

    $this->browse(function (Browser $browser) use ($dinas, $program) {
        $browser->loginAs($dinas)
            ->visit("/dinas/program/{$program->id}/edit")
            ->assertInputValue('name', 'Program Lama')
            ->type('name', 'Program Lama (Updated)')
            ->press('Simpan Perubahan')
            ->waitForText('berhasil')
            ->assertSee('berhasil')
            ->assertSee('Program Lama (Updated)');
    });
});

test('PBI#4 - dinas dapat menghapus program', function () {
    $dinas = User::factory()->create([
        'role' => 'dinas',
        'password' => bcrypt('password'),
    ]);

    $program = Program::factory()->create([
        'name' => 'Program Akan Dihapus',
        'jenis' => 'pembinaan',
        'status' => 'active',
    ]);

    $this->browse(function (Browser $browser) use ($dinas) {
        $browser->loginAs($dinas)
            ->visit('/dinas/program')
            ->assertSee('Program Akan Dihapus')
            ->press('Hapus')
            ->acceptDialog()
            ->waitForText('berhasil')
            ->assertSee('berhasil')
            ->assertDontSee('Program Akan Dihapus');
    });
});

// ─── PBI #5: Approval ─────────────────────────────────────────────────────────

test('PBI#5 - dinas dapat menyetujui pengajuan', function () {
    $dinas = User::factory()->create([
        'role' => 'dinas',
        'password' => bcrypt('password'),
    ]);

    $umkm = User::factory()->create([
        'role' => 'umkm',
        'profile_status' => 'verified',
    ]);

    $program = Program::factory()->create([
        'jenis' => 'pendanaan',
        'status' => 'active',
    ]);

    $pengajuan = Pengajuan::create([
        'user_id' => $umkm->id,
        'program_id' => $program->id,
        'jenis' => 'pendanaan',
        'kebutuhan_usaha' => 'Butuh modal untuk ekspansi usaha',
        'status' => 'pending',
    ]);

    $this->browse(function (Browser $browser) use ($dinas, $pengajuan) {
        $browser->loginAs($dinas)
            ->visit("/dinas/pengajuan/{$pengajuan->id}")
            ->assertSee('Detail Pengajuan')
            ->assertSee('Pending')
            ->press('Setujui')
            ->acceptDialog()
            ->waitForText('berhasil')
            ->assertSee('berhasil');
    });

    expect(Pengajuan::find($pengajuan->id)->status)->toBe('approved');
});

test('PBI#5 - dinas dapat menolak pengajuan', function () {
    $dinas = User::factory()->create([
        'role' => 'dinas',
        'password' => bcrypt('password'),
    ]);

    $umkm = User::factory()->create([
        'role' => 'umkm',
        'profile_status' => 'verified',
    ]);

    $program = Program::factory()->create([
        'jenis' => 'pembinaan',
        'status' => 'active',
    ]);

    $pengajuan = Pengajuan::create([
        'user_id' => $umkm->id,
        'program_id' => $program->id,
        'jenis' => 'pembinaan',
        'kebutuhan_usaha' => 'Butuh pelatihan manajemen keuangan',
        'status' => 'pending',
    ]);

    $this->browse(function (Browser $browser) use ($dinas, $pengajuan) {
        $browser->loginAs($dinas)
            ->visit("/dinas/pengajuan/{$pengajuan->id}")
            ->assertSee('Detail Pengajuan')
            ->press('Tolak')
            ->acceptDialog()
            ->waitForText('berhasil')
            ->assertSee('berhasil');
    });

    expect(Pengajuan::find($pengajuan->id)->status)->toBe('rejected');
});

// ─── PBI #6: Notes ────────────────────────────────────────────────────────────

test('PBI#6 - dinas dapat menyetujui pengajuan dengan catatan', function () {
    $dinas = User::factory()->create([
        'role' => 'dinas',
        'password' => bcrypt('password'),
    ]);

    $umkm = User::factory()->create([
        'role' => 'umkm',
        'profile_status' => 'verified',
    ]);

    $program = Program::factory()->create([
        'jenis' => 'pendanaan',
        'status' => 'active',
    ]);

    $pengajuan = Pengajuan::create([
        'user_id' => $umkm->id,
        'program_id' => $program->id,
        'jenis' => 'pendanaan',
        'kebutuhan_usaha' => 'Butuh dana untuk beli mesin baru',
        'status' => 'pending',
    ]);

    $this->browse(function (Browser $browser) use ($dinas, $pengajuan) {
        $browser->loginAs($dinas)
            ->visit("/dinas/pengajuan/{$pengajuan->id}")
            ->assertSee('Detail Pengajuan')
            ->type('#notes', 'Pengajuan disetujui, dana akan dicairkan bulan depan.')
            ->press('Setujui')
            ->acceptDialog()
            ->waitForText('berhasil')
            ->assertSee('berhasil');
    });

    $updated = Pengajuan::find($pengajuan->id);
    expect($updated->status)->toBe('approved');
    expect($updated->notes)->toBe('Pengajuan disetujui, dana akan dicairkan bulan depan.');
});

test('PBI#6 - dinas dapat menolak pengajuan dengan catatan alasan', function () {
    $dinas = User::factory()->create([
        'role' => 'dinas',
        'password' => bcrypt('password'),
    ]);

    $umkm = User::factory()->create([
        'role' => 'umkm',
        'profile_status' => 'verified',
    ]);

    $program = Program::factory()->create([
        'jenis' => 'pembinaan',
        'status' => 'active',
    ]);

    $pengajuan = Pengajuan::create([
        'user_id' => $umkm->id,
        'program_id' => $program->id,
        'jenis' => 'pembinaan',
        'kebutuhan_usaha' => 'Butuh pelatihan ekspor produk',
        'status' => 'pending',
    ]);

    $this->browse(function (Browser $browser) use ($dinas, $pengajuan) {
        $browser->loginAs($dinas)
            ->visit("/dinas/pengajuan/{$pengajuan->id}")
            ->assertSee('Detail Pengajuan')
            ->type('#notes', 'Dokumen tidak lengkap, silakan lengkapi dan ajukan kembali.')
            ->press('Tolak')
            ->acceptDialog()
            ->waitForText('berhasil')
            ->assertSee('berhasil');
    });

    $updated = Pengajuan::find($pengajuan->id);
    expect($updated->status)->toBe('rejected');
    expect($updated->notes)->toBe('Dokumen tidak lengkap, silakan lengkapi dan ajukan kembali.');
});
