@extends('layouts.app')

@section('title', 'Pengajuan Pendanaan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pendanaan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Pengajuan Pendanaan <span style="margin: 0 0.5rem;">&rsaquo;</span> <span style="color: var(--color-primary); font-weight: 700;">Riwayat & Status</span>
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
@php
    $isVerified = Auth::user()->profile_status === 'verified';
@endphp

<div class="flex flex-col gap-6" style="max-width: 68rem; margin: 0 auto;">
    <div class="page-header">
        <div>
            <div class="page-kicker">Pendanaan Usaha</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Pengajuan Pendanaan UMKM</h1>
            <p class="page-subtitle">Ajukan permohonan pendanaan usaha dan pantau status review dari Dinas.</p>
        </div>
        @if($isVerified)
            <a href="{{ route('umkm.pendanaan.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Ajukan Pendanaan
            </a>
        @endif
    </div>

    @if(!$isVerified)
        <div class="alert alert-warning" style="display: flex; justify-content: space-between; align-items: center; gap: var(--space-4); flex-wrap: wrap;">
            <span><strong>Akun belum diverifikasi.</strong> Lengkapi profil usaha agar pengajuan pendanaan dapat dikirim.</span>
            <a href="{{ route('umkm.profile.show') }}" class="link-action">Cek Profil</a>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); margin-bottom: var(--space-4); flex-wrap: wrap;">
            <div>
                <h2 class="section-title">Riwayat Pengajuan</h2>
                <p class="section-subtitle">Daftar pengajuan pendanaan yang pernah dikirim oleh UMKM Anda.</p>
            </div>
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Total Pengajuan</span>
                <div class="detail-value" style="font-weight: 800;">{{ $pengajuans->count() }}</div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Sumber Pendanaan</th>
                        <th style="text-align: right;">Jumlah</th>
                        <th>Tujuan</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuans as $item)
                        <tr>
                            <td style="white-space: nowrap;">{{ $item->submitted_at ? $item->submitted_at->format('d M Y') : $item->created_at->format('d M Y') }}</td>
                            <td>
                                <div style="font-weight: 700; color: var(--color-gray-900);">{{ $item->sumberPendanaan->nama_program ?? 'Belum tersedia' }}</div>
                                @if($item->sumberPendanaan?->mitra_penyalur)
                                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 2px;">{{ $item->sumberPendanaan->mitra_penyalur }}</div>
                                @endif
                            </td>
                            <td style="text-align: right; white-space: nowrap; font-weight: 700; color: var(--color-gray-900);">Rp {{ number_format($item->jumlah_pengajuan, 0, ',', '.') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->tujuan_pendanaan ?: 'Belum tersedia', 42) }}</td>
                            <td style="text-align: center;">
                                <x-pendanaan-status-badge :status="$item->status" />
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('umkm.pendanaan.show', $item) }}" class="link-action">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <div class="icon-chip gold" style="margin: 0 auto var(--space-3);">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22"></path><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    </div>
                                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada pengajuan pendanaan</h3>
                                    <p style="margin-bottom: var(--space-4);">Riwayat pengajuan pendanaan akan muncul setelah formulir dikirim.</p>
                                    @if($isVerified)
                                        <a href="{{ route('umkm.pendanaan.create') }}" class="btn btn-primary">Ajukan Pendanaan</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
