@extends('layouts.app')

@section('title', 'Detail Pengajuan Pendanaan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pendanaan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.pendanaan.index') }}" style="color: var(--color-text-muted); text-decoration: none;">Pengajuan Pendanaan</a>
        <span style="margin: 0 0.5rem;">&rsaquo;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Detail Pengajuan</span>
    </div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 56rem; margin: 0 auto;">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <a href="{{ route('umkm.pendanaan.index') }}" class="link-action">Kembali ke Riwayat</a>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-2);">Detail Pengajuan Pendanaan</h1>
            <p class="page-subtitle">Ringkasan pengajuan, dokumen pendukung, dan hasil review Dinas.</p>
        </div>
        <x-pendanaan-status-badge :status="$pengajuanPendanaan->status" />
    </div>

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); margin-bottom: var(--space-5); flex-wrap: wrap;">
            <div>
                <div class="page-kicker">Ringkasan</div>
                <h2 class="section-title" style="margin-top: var(--space-1);">{{ $pengajuanPendanaan->tujuan_pendanaan ?: 'Pengajuan Pendanaan' }}</h2>
            </div>
            <div style="text-align: right;">
                <div class="detail-label">Jumlah Pengajuan</div>
                <div class="detail-value" style="font-size: 1.25rem; font-weight: 800;">Rp {{ number_format($pengajuanPendanaan->jumlah_pengajuan, 0, ',', '.') }}</div>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-label">Tanggal Pengajuan</div>
                <div class="detail-value">{{ $pengajuanPendanaan->submitted_at ? $pengajuanPendanaan->submitted_at->format('d M Y, H:i') : $pengajuanPendanaan->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Sumber Pendanaan</div>
                <div class="detail-value" style="font-weight: 700;">{{ $pengajuanPendanaan->sumberPendanaan?->nama_program ?? 'Belum tersedia' }}</div>
                @if($pengajuanPendanaan->sumberPendanaan)
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted);">
                        Mitra: {{ $pengajuanPendanaan->sumberPendanaan->mitra_penyalur ?? 'Belum tersedia' }} / Batas: Rp {{ number_format($pengajuanPendanaan->sumberPendanaan->batas_maksimal, 0, ',', '.') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="detail-section" style="margin-top: var(--space-5);">
            <div class="detail-label">Deskripsi Kebutuhan</div>
            <div class="soft-panel" style="white-space: pre-line;">{{ $pengajuanPendanaan->deskripsi_kebutuhan ?: 'Belum tersedia' }}</div>
        </div>
    </section>

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); flex-wrap: wrap;">
            <div>
                <h2 class="section-title">Dokumen Pendukung</h2>
                <p class="section-subtitle">Lampiran yang dikirim bersama pengajuan pendanaan.</p>
            </div>
            @if($pengajuanPendanaan->dokumen_pendukung)
                <a href="{{ route('pendanaan.dokumen', $pengajuanPendanaan) }}" target="_blank" class="btn btn-secondary">Lihat Dokumen</a>
            @endif
        </div>
        @unless($pengajuanPendanaan->dokumen_pendukung)
            <div class="soft-panel" style="margin-top: var(--space-4); color: var(--color-text-muted);">Belum ada dokumen pendukung yang dilampirkan.</div>
        @endunless
    </section>

    <section class="content-card">
        <h2 class="section-title">Review Dinas</h2>
        <p class="section-subtitle">Catatan dan waktu review akan tampil setelah pengajuan diproses.</p>
        <div class="detail-grid" style="margin-top: var(--space-5);">
            <div class="detail-section">
                <div class="detail-label">Catatan Petugas</div>
                <div class="soft-panel" style="white-space: pre-line;">{{ $pengajuanPendanaan->catatan ?: 'Belum ada catatan' }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Direview Oleh</div>
                <div class="detail-value">{{ $pengajuanPendanaan->reviewer?->name ?? 'Belum direview' }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Tanggal Review</div>
                <div class="detail-value">{{ $pengajuanPendanaan->reviewed_at ? $pengajuanPendanaan->reviewed_at->format('d M Y, H:i') : 'Belum tersedia' }}</div>
            </div>
        </div>
    </section>
</div>
@endsection
