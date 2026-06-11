@extends('layouts.app')

@section('title', 'Dashboard UMKM - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="dashboard" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Dashboard UMKM</div>
        <div class="page-subtitle">Pantau profil usaha, pendanaan, event, notifikasi, dan laporan berkala dalam satu halaman.</div>
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
@php
    $profileStatus = Auth::user()->profile_status;
    $profileStatusLabel = match ($profileStatus) {
        'verified' => 'Terverifikasi',
        'rejected' => 'Ditolak',
        default => 'Menunggu Verifikasi',
    };
    $profileStatusClass = match ($profileStatus) {
        'verified' => 'badge-success',
        'rejected' => 'badge-danger',
        default => 'badge-warning',
    };
@endphp

<div class="flex flex-col gap-6">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($profileStatus === 'pending')
        <div class="alert alert-warning">
            <strong>Profil Anda menunggu verifikasi.</strong>
            Lengkapi dan pastikan data usaha sudah benar agar proses verifikasi Dinas berjalan lancar.
            <a href="{{ route('umkm.profile.show') }}" class="link-action" style="margin-left: 0.5rem;">Cek Profil</a>
        </div>
    @elseif($profileStatus === 'rejected')
        <div class="alert alert-danger">
            <strong>Verifikasi profil ditolak.</strong>
            Perbarui data profil sesuai catatan petugas sebelum mengajukan kembali.
            <a href="{{ route('umkm.profile.edit') }}" class="link-action" style="margin-left: 0.5rem;">Edit Profil</a>
        </div>
    @endif

    <section class="soft-panel">
        <div class="page-kicker">Portal UMKM Kabupaten Bandung</div>
        <div class="stat-card-row" style="margin-top: var(--space-3); align-items: center;">
            <div>
                <h1 style="font-size: 1.65rem; font-weight: 800; color: var(--color-gray-900); line-height: 1.25;">
                    Selamat datang, {{ Auth::user()->name }}
                </h1>
                <p class="section-subtitle">
                    {{ $profile?->business_name ? 'Kelola perkembangan '.$profile->business_name.' dari dashboard ini.' : 'Lengkapi profil usaha agar fitur layanan dapat digunakan optimal.' }}
                </p>
            </div>
            <span class="badge {{ $profileStatusClass }}">{{ $profileStatusLabel }}</span>
        </div>
    </section>

    <section class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Kelengkapan Profil</div>
                    <div class="stat-value">{{ $profileCompleteness ?? 0 }}%</div>
                </div>
                <div class="icon-chip gold">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
            </div>
            <div class="progress-track"><div class="progress-fill" style="width: {{ $profileCompleteness ?? 0 }}%;"></div></div>
            <a href="{{ route('umkm.profile.edit') }}" class="link-action">Lengkapi Profil</a>
        </div>

        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Pengajuan Pendanaan</div>
                    <div class="stat-value">{{ $totalPendanaan ?? 0 }}</div>
                </div>
                <div class="icon-chip">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22"></path><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
            </div>
            <div class="stat-note">Ajukan dan pantau rekomendasi pendanaan usaha.</div>
            <a href="{{ route('umkm.pendanaan.index') }}" class="link-action">Kelola Pendanaan</a>
        </div>

        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Laporan Berkala</div>
                    <div class="stat-value">{{ $totalLaporan ?? 0 }}</div>
                </div>
                <div class="icon-chip">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                </div>
            </div>
            <div class="stat-note">Kirim laporan berkala perkembangan usaha Anda.</div>
            <a href="{{ route('umkm.laporan_berkala.index') }}" class="link-action">Kelola Laporan Berkala</a>
        </div>

        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Event dan Pelatihan</div>
                    <div class="stat-value" style="font-size: 1.45rem;">Aktif</div>
                </div>
                <div class="icon-chip gold">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
            </div>
            <div class="stat-note">Ikuti event dan pelatihan dari Dinas.</div>
            <a href="{{ route('umkm.event') }}" class="link-action">Lihat Event</a>
        </div>
    </section>

    <section class="dashboard-section-grid">
        <div class="content-card">
            <div class="stat-card-row" style="margin-bottom: var(--space-4);">
                <div>
                    <h2 class="section-title">Alur Layanan Utama</h2>
                    <p class="section-subtitle">Gunakan menu utama sesuai kebutuhan usaha Anda.</p>
                </div>
            </div>

            <div class="section-list">
                <div class="list-card">
                    <div class="stat-label">Pendanaan Usaha</div>
                    <div class="detail-value" style="margin-top: var(--space-2);">Ajukan dan pantau rekomendasi pendanaan usaha.</div>
                    <a href="{{ route('umkm.pendanaan.index') }}" class="link-action" style="display: inline-block; margin-top: var(--space-3);">Buka Pengajuan Pendanaan</a>
                </div>
                <div class="list-card">
                    <div class="stat-label">Event dan Pelatihan</div>
                    <div class="detail-value" style="margin-top: var(--space-2);">Temukan kegiatan pelatihan, buka detail event, lalu daftar langsung.</div>
                    <a href="{{ route('umkm.event') }}" class="link-action" style="display: inline-block; margin-top: var(--space-3);">Lihat Event</a>
                </div>
                <div class="list-card">
                    <div class="stat-label">Laporan Berkala</div>
                    <div class="detail-value" style="margin-top: var(--space-2);">Kirim laporan berkala perkembangan usaha Anda secara periodik.</div>
                    <a href="{{ route('umkm.laporan_berkala.index') }}" class="link-action" style="display: inline-block; margin-top: var(--space-3);">Kelola Laporan Berkala</a>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="stat-card-row" style="margin-bottom: var(--space-4);">
                <div>
                    <h2 class="section-title">Pembaruan dan Bantuan</h2>
                    <p class="section-subtitle">Pantau informasi terbaru atau akses materi pendukung.</p>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <div class="list-card">
                    <div style="font-weight: 800; color: var(--color-gray-900);">Notifikasi</div>
                    <div class="stat-note" style="margin-top: var(--space-1);">Pantau informasi terbaru melalui notifikasi.</div>
                    <a href="{{ route('umkm.notifications.index') }}" class="link-action" style="display: inline-block; margin-top: var(--space-3);">Buka Notifikasi</a>
                </div>
                <div class="list-card">
                    <div style="font-weight: 800; color: var(--color-gray-900);">Materi Edukasi</div>
                    <div class="stat-note" style="margin-top: var(--space-1);">Pelajari materi pembinaan untuk mengembangkan usaha.</div>
                    <a href="{{ route('umkm.materi-edukasi.index') }}" class="link-action" style="display: inline-block; margin-top: var(--space-3);">Lihat Materi</a>
                </div>
                <div class="list-card">
                    <div style="font-weight: 800; color: var(--color-gray-900);">Panduan dan Bantuan</div>
                    <div class="stat-note" style="margin-top: var(--space-1);">Baca panduan penggunaan portal atau FAQ layanan.</div>
                    <a href="{{ route('umkm.panduan') }}" class="link-action" style="display: inline-block; margin-top: var(--space-3);">Buka Panduan</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
