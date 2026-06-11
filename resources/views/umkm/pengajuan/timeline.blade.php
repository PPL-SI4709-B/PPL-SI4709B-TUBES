@extends('layouts.app')

@section('title', 'Timeline Pengajuan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pengajuan" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Timeline Pengajuan</div>
        <div class="page-subtitle">Riwayat perubahan status pengajuan program.</div>
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
<div class="support-page narrow">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Pengajuan Program</div>
            <h1>Timeline Perubahan Status Pengajuan</h1>
            <p class="page-subtitle">Catatan status dan keterangan dari sistem atau petugas Dinas.</p>
        </div>
    </div>

    <section class="content-card">
        <div class="section-list">
            @if(isset($logs) && $logs->count() > 0)
                @foreach($logs as $log)
                    <article class="list-card" style="display: flex; gap: var(--space-4);">
                        <span class="support-icon" style="width: 2rem; height: 2rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        </span>
                        <div>
                            <div class="support-meta">{{ $log->created_at->format('d M Y H:i') }}</div>
                            <h2 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin: var(--space-1) 0;">Status: {{ ucfirst($log->status) }}</h2>
                            <p class="stat-note" style="line-height: 1.6;">{{ $log->catatan ?? 'Tidak ada catatan' }}</p>
                            <p class="stat-note" style="margin-top: var(--space-2);">Oleh: {{ $log->user ? $log->user->name : 'Sistem' }}</p>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="support-empty-state">
                    <span class="support-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                    </span>
                    <h3>Belum ada data</h3>
                    <p>Belum ada perubahan status pengajuan yang tercatat.</p>
                    <div style="margin-top: var(--space-5);">
                        <a href="{{ route('umkm.dashboard') }}" class="btn btn-primary">Kembali ke Dashboard</a>
                    </div>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
