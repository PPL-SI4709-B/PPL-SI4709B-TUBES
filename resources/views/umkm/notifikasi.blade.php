@extends('layouts.app')

@section('title', 'Notifikasi dan Riwayat - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="notifications" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Notifikasi dan Riwayat Status</div>
        <div class="page-subtitle">Lihat pembaruan layanan dan perubahan status layanan.</div>
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
<div class="support-page">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Pembaruan Akun</div>
            <h1>Notifikasi dan Riwayat Status</h1>
            <p class="page-subtitle">Informasi terbaru dari sistem dan catatan perubahan status layanan Anda.</p>
        </div>
    </div>

    <div class="support-grid">
        <section class="content-card">
            <div style="margin-bottom: var(--space-5);">
                <h2 class="section-title">Semua Notifikasi</h2>
                <p class="section-subtitle">Pesan dan informasi terbaru untuk akun UMKM Anda.</p>
            </div>

            <div class="section-list">
                @forelse ($notifications ?? [] as $notif)
                    <article class="list-card" style="background-color: {{ $notif['is_read'] ? '#FFFFFF' : 'var(--color-primary-soft)' }};">
                        <div class="stat-card-row">
                            <h3 style="font-size: var(--text-sm); font-weight: 800; color: var(--color-gray-900); margin: 0;">{{ $notif['title'] }}</h3>
                            <span class="stat-note">{{ $notif['created_at'] }}</span>
                        </div>
                        <p class="stat-note" style="margin-top: var(--space-2); line-height: 1.6;">{{ $notif['message'] }}</p>
                    </article>
                @empty
                    <div class="support-empty-state">
                        <span class="support-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </span>
                        <h3>Belum ada notifikasi</h3>
                        <p>Belum ada pembaruan baru untuk akun Anda.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="content-card">
            <div style="margin-bottom: var(--space-5);">
                <h2 class="section-title">Riwayat Perubahan Status</h2>
                <p class="section-subtitle">Catatan perubahan status layanan.</p>
            </div>

            <div class="section-list">
                @forelse ($statusLogs ?? [] as $log)
                    <article class="list-card">
                        <div style="display: flex; gap: var(--space-3); align-items: flex-start;">
                            <span class="support-icon" style="width: 2rem; height: 2rem;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                            </span>
                            <div>
                                <h3 style="font-size: var(--text-sm); font-weight: 800; color: var(--color-gray-900); margin: 0;">{{ $log['status'] }}</h3>
                                <p class="stat-note" style="margin-top: var(--space-1);">{{ $log['catatan'] ?? 'Status layanan diperbarui.' }}</p>
                                <div class="stat-note" style="margin-top: var(--space-1);">{{ $log['created_at'] }}</div>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="support-empty-state">
                        <span class="support-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        </span>
                        <h3>Belum ada riwayat</h3>
                        <p>Belum ada perubahan status layanan yang tercatat.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
