@extends('layouts.app')

@section('title', 'Panduan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="panduan" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Panduan</div>
        <div class="page-subtitle">Panduan singkat penggunaan fitur utama Portal UMKM.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="support-page">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Bantuan UMKM</div>
            <h1>Panduan Penggunaan Portal UMKM</h1>
            <p class="page-subtitle">Ikuti langkah-langkah berikut untuk menggunakan fitur utama Portal UMKM.</p>
        </div>
    </div>

    <section class="content-card">
        <div class="guide-grid">
            <article class="guide-card">
                <div class="guide-step">
                    <span class="step-badge">01</span>
                    <h2>Melengkapi Profil Usaha</h2>
                </div>
                <p>Lengkapi data usaha agar pengajuan dan layanan Dinas dapat diproses dengan lancar.</p>
                <ul class="guide-list">
                    <li>Buka menu Profil UMKM di sidebar.</li>
                    <li>Periksa data pemilik, alamat, kategori, wilayah, dan skala usaha.</li>
                    <li>Unggah dokumen yang diperlukan bila tersedia.</li>
                    <li>Simpan perubahan dan tunggu proses verifikasi Dinas.</li>
                </ul>
            </article>

            <article class="guide-card">
                <div class="guide-step">
                    <span class="step-badge">02</span>
                    <h2>Mengajukan Pendanaan</h2>
                </div>
                <p>Gunakan fitur pendanaan untuk mengajukan rekomendasi bantuan modal atau akses pembiayaan.</p>
                <ul class="guide-list">
                    <li>Buka menu Pengajuan Pendanaan.</li>
                    <li>Pilih sumber pendanaan yang tersedia.</li>
                    <li>Isi jumlah, tujuan, dan deskripsi kebutuhan pendanaan.</li>
                    <li>Lampirkan dokumen pendukung sebelum mengirim pengajuan.</li>
                </ul>
            </article>

            <article class="guide-card">
                <div class="guide-step">
                    <span class="step-badge">03</span>
                    <h2>Mendaftar Event dan Pelatihan</h2>
                </div>
                <p>Ikuti kegiatan pelatihan, workshop, atau event pembinaan yang dibuka oleh Dinas.</p>
                <ul class="guide-list">
                    <li>Buka menu Event dan Pelatihan.</li>
                    <li>Pilih event yang relevan dengan kebutuhan usaha.</li>
                    <li>Buka detail event untuk melihat jadwal, lokasi, dan kuota.</li>
                    <li>Daftar sebelum kuota atau periode pendaftaran berakhir.</li>
                </ul>
            </article>

            <article class="guide-card">
                <div class="guide-step">
                    <span class="step-badge">04</span>
                    <h2>Mengirim Laporan Berkala</h2>
                </div>
                <p>Kirim laporan berkala agar Dinas dapat memantau perkembangan usaha Anda secara periodik.</p>
                <ul class="guide-list">
                    <li>Buka menu Laporan Berkala.</li>
                    <li>Isi periode, omzet, jumlah karyawan, kendala, dan strategi usaha.</li>
                    <li>Simpan draft jika data belum lengkap.</li>
                    <li>Kirim laporan setelah semua informasi sudah benar.</li>
                </ul>
            </article>

            <article class="guide-card">
                <div class="guide-step">
                    <span class="step-badge">05</span>
                    <h2>Melihat Status dan Notifikasi</h2>
                </div>
                <p>Gunakan notifikasi untuk mengikuti pembaruan pendanaan, event, dan informasi dari Dinas.</p>
                <ul class="guide-list">
                    <li>Buka menu Notifikasi dari sidebar.</li>
                    <li>Baca pembaruan status terbaru dari petugas.</li>
                    <li>Tandai notifikasi sebagai dibaca setelah ditinjau.</li>
                    <li>Gunakan catatan status sebagai panduan tindak lanjut.</li>
                </ul>
            </article>

            <article class="guide-card">
                <div class="guide-step">
                    <span class="step-badge">06</span>
                    <h2>Mengakses Materi Edukasi dan Bantuan</h2>
                </div>
                <p>Manfaatkan materi edukasi dan pusat bantuan untuk memahami layanan portal dengan lebih mudah.</p>
                <ul class="guide-list">
                    <li>Buka menu Materi Edukasi untuk membaca atau mengunduh materi pembinaan.</li>
                    <li>Gunakan FAQ dan Bantuan saat membutuhkan jawaban cepat.</li>
                    <li>Buka Panduan kapan pun perlu mengingat alur penggunaan portal.</li>
                    <li>Hubungi Dinas melalui kontak bantuan jika masih membutuhkan pendampingan.</li>
                </ul>
            </article>
        </div>
    </section>

    <section class="support-grid">
        <div class="support-card">
            <div class="guide-step">
                <span class="support-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 4h16v16H4z"></path><path d="m22 6-10 7L2 6"></path></svg>
                </span>
                <h2>Email Bantuan</h2>
            </div>
            <p style="margin-top: var(--space-3);">diskopukm@bandungkab.go.id</p>
            <p>Senin sampai Jumat, pukul 08.00-16.00 WIB.</p>
        </div>

        <div class="support-card">
            <div class="guide-step">
                <span class="support-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 3 5.18 2 2 0 0 1 5 3h3a2 2 0 0 1 2 1.72c.1.75.27 1.49.5 2.2a2 2 0 0 1-.45 2.11L9 10.09a16 16 0 0 0 4.91 4.91l1.06-1.06a2 2 0 0 1 2.11-.45c.71.23 1.45.4 2.2.5A2 2 0 0 1 22 16.92z"></path></svg>
                </span>
                <h2>Telepon / WhatsApp</h2>
            </div>
            <p style="margin-top: var(--space-3);">+62 811-2222-3333</p>
            <p>Layanan pengaduan dan bantuan UMKM Kabupaten Bandung.</p>
        </div>
    </section>
</div>
@endsection
