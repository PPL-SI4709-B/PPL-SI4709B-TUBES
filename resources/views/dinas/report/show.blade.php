@extends('layouts.app')

@section('title', 'Detail Laporan Berkala')

@section('sidebar')
<x-dinas-sidebar active="report" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Detail Laporan Berkala</div>
        <div class="page-subtitle">Detail laporan periodik yang dikirim UMKM.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">
    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <a href="{{ route('dinas.report.index') }}" class="link-action">Kembali ke Daftar Laporan Berkala</a>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-2);">Laporan {{ $report->kuartal }} {{ $report->tahun }}</h1>
            <p class="page-subtitle">Laporan berkala perkembangan usaha yang dikirim oleh UMKM.</p>
        </div>
        <span class="badge badge-success">Terkirim</span>
    </div>

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); margin-bottom: var(--space-5); flex-wrap: wrap;">
            <div>
                <div class="page-kicker">Laporan Berkala UMKM</div>
                <h2 class="section-title" style="margin-top: var(--space-1);">Ringkasan Laporan</h2>
            </div>
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Dikirim</span>
                <div class="detail-value" style="font-weight: 800;">{{ $report->updated_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-label">Nama Pemilik/User</div>
                <div class="detail-value" style="font-weight: 700;">{{ $report->user?->name ?? 'Belum tersedia' }}</div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $report->user?->email ?? 'Belum tersedia' }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Nama UMKM</div>
                <div class="detail-value" style="font-weight: 700;">{{ $report->user?->umkmProfile?->business_name ?? 'Belum tersedia' }}</div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $report->user?->umkmProfile?->business_address ?? 'Alamat belum tersedia' }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Kategori / Wilayah / Skala</div>
                <div class="detail-value">
                    {{ $report->user?->umkmProfile?->category?->name ?? 'Kategori belum tersedia' }} /
                    {{ $report->user?->umkmProfile?->region?->name ?? 'Wilayah belum tersedia' }} /
                    {{ $report->user?->umkmProfile?->scale?->name ?? 'Skala belum tersedia' }}
                </div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Periode</div>
                <div class="detail-value" style="font-weight: 700;">{{ $report->kuartal }} {{ $report->tahun }}</div>
            </div>
        </div>
    </section>

    <section class="dashboard-grid tight">
        <div class="content-card">
            <div class="stat-label">Omzet Kuartal Ini</div>
            <div class="stat-value" style="font-size: 1.5rem;">{{ $report->omzet !== null ? 'Rp '.number_format($report->omzet, 0, ',', '.') : '-' }}</div>
        </div>
        <div class="content-card">
            <div class="stat-label">Jumlah Karyawan</div>
            <div class="stat-value" style="font-size: 1.5rem;">{{ $report->jumlah_karyawan !== null ? $report->jumlah_karyawan : '-' }}</div>
            <div class="stat-note">Orang</div>
        </div>
    </section>

    <section class="content-card">
        <h2 class="section-title">Kendala yang Dihadapi</h2>
        <p class="section-subtitle">Catatan kendala dari UMKM pada periode laporan.</p>
        <div class="soft-panel" style="margin-top: var(--space-4); white-space: pre-line;">{{ $report->kendala ?: 'Belum ada kendala yang dicatat.' }}</div>
    </section>

    <section class="content-card">
        <h2 class="section-title">Strategi ke Depan</h2>
        <p class="section-subtitle">Rencana tindak lanjut usaha dari UMKM.</p>
        <div class="soft-panel" style="margin-top: var(--space-4); white-space: pre-line;">{{ $report->strategi_kedepan ?: 'Belum ada strategi yang dicatat.' }}</div>
    </section>

    <section class="content-card">
        <h2 class="section-title">Catatan Review</h2>
        <p class="section-subtitle">Tabel laporan berkala saat ini belum memiliki kolom review/catatan Dinas. Halaman ini menampilkan data laporan berkala yang sudah dikirim agar Dinas dapat memantau laporan utama UMKM tanpa memakai data laporan legacy.</p>
    </section>
</div>
@endsection
