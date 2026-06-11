@extends('layouts.app')

@section('title', 'FAQ dan Bantuan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="faq" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">FAQ dan Bantuan</div>
        <div class="page-subtitle">Jawaban singkat untuk pertanyaan umum seputar layanan UMKM.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()?->name ?? 'Pemilik Usaha' }}</div>
            <div class="user-role" style="text-transform: none;">{{ Auth::user()?->role ?? 'UMKM' }}</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()?->name ?? 'Pemilik Usaha') }}&background=064E3B&color=fff&rounded=true" alt="Avatar" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="support-page narrow">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Pusat Bantuan</div>
            <h1>FAQ dan Bantuan</h1>
            <p class="page-subtitle">Pertanyaan yang sering diajukan mengenai penggunaan Portal UMKM.</p>
        </div>
    </div>

    <section class="content-card">
        <div class="section-list">
            <article class="support-card">
                <div class="guide-step">
                    <span class="support-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"></circle><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                    </span>
                    <h2>Bagaimana cara mengajukan pendanaan?</h2>
                </div>
                <p style="margin-top: var(--space-3);">Buka menu Pengajuan Pendanaan, pilih sumber pendanaan, isi kebutuhan usaha, lalu kirim setelah dokumen pendukung lengkap.</p>
            </article>

            <article class="support-card">
                <div class="guide-step">
                    <span class="support-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"></circle><path d="M9.1 9a3 3 0 0 1 5.8 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                    </span>
                    <h2>Berapa lama proses persetujuan pengajuan?</h2>
                </div>
                <p style="margin-top: var(--space-3);">Proses verifikasi dilakukan oleh petugas Dinas. Status terbaru dapat dilihat melalui dashboard, halaman pengajuan, atau notifikasi.</p>
            </article>

            <article class="support-card">
                <div class="guide-step">
                    <span class="support-icon">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    </span>
                    <h2>Kapan laporan perkembangan usaha dikirim?</h2>
                </div>
                <p style="margin-top: var(--space-3);">Laporan berkala dikirim sesuai periode kuartal. Isi laporan omzet, karyawan, kendala, dan strategi usaha sebelum dikirim.</p>
            </article>
        </div>
    </section>

    <section class="support-card">
        <div class="guide-step">
            <span class="support-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.8 19.8 0 0 1 3 5.18 2 2 0 0 1 5 3h3a2 2 0 0 1 2 1.72c.1.75.27 1.49.5 2.2a2 2 0 0 1-.45 2.11L9 10.09a16 16 0 0 0 4.91 4.91l1.06-1.06a2 2 0 0 1 2.11-.45c.71.23 1.45.4 2.2.5A2 2 0 0 1 22 16.92z"></path></svg>
            </span>
            <h2>Kontak Dinas Koperasi dan UKM Kabupaten Bandung</h2>
        </div>
        <ul class="clean-list" style="margin-top: var(--space-4);">
            <li>Email: support@umkm-bandung.go.id</li>
            <li>Telepon: (022) 1234567</li>
            <li>Alamat: Jl. Raya Soreang Km. 17, Kabupaten Bandung</li>
        </ul>
    </section>
</div>
@endsection
