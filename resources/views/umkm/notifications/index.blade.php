@extends('layouts.app')

@section('title', 'Notifikasi - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="notifications" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Notifikasi</div>
        <div class="page-subtitle">Pembaruan status dan pesan layanan untuk akun UMKM Anda.</div>
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
            <div class="page-kicker">Pembaruan Akun</div>
            <h1>Notifikasi dan Riwayat Status</h1>
            <p class="page-subtitle">Tinjau notifikasi terbaru dan riwayat status layanan Anda.</p>
        </div>
    </div>

    <div class="support-grid">
        <section class="content-card">
            <div style="margin-bottom: var(--space-5);">
                <h2 class="section-title">Notifikasi Baru</h2>
                <p class="section-subtitle">Pesan yang dikirim oleh sistem atau petugas Dinas.</p>
            </div>

            <div class="section-list">
                @forelse($notifications as $notification)
                    @php
                        $data = is_string($notification->data) ? json_decode($notification->data, true) : $notification->data;
                        $data = is_array($data) ? $data : [];
                        $isUnread = is_null($notification->read_at);
                    @endphp
                    <article class="list-card" style="background-color: {{ $isUnread ? 'var(--color-primary-soft)' : '#FFFFFF' }};">
                        <div class="stat-card-row">
                            <div>
                                <h3 style="font-size: var(--text-sm); font-weight: 800; color: var(--color-gray-900); margin: 0;">{{ $data['title'] ?? 'Notifikasi' }}</h3>
                                <p class="stat-note" style="margin-top: var(--space-1); line-height: 1.6;">{{ $data['message'] ?? '' }}</p>
                                <span class="stat-note" style="display: block; margin-top: var(--space-2);">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                            @if($isUnread)
                                <form action="{{ route('umkm.notifications.read', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="link-action">Tandai Dibaca</button>
                                </form>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="support-empty-state">
                        <span class="support-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </span>
                        <h3>Belum ada notifikasi</h3>
                        <p>Tidak ada notifikasi saat ini.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="content-card">
            <div style="margin-bottom: var(--space-5);">
                <h2 class="section-title">Riwayat Status Layanan</h2>
                <p class="section-subtitle">Ringkasan status terbaru dari layanan yang Anda ajukan.</p>
            </div>

            <div class="section-list">
                @forelse($pengajuans as $pengajuan)
                    @php
                        $statusClass = match($pengajuan->status) {
                            'approved' => 'badge-success',
                            'rejected' => 'badge-danger',
                            default => 'badge-warning',
                        };
                        $label = match($pengajuan->status) {
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            default => 'Menunggu Verifikasi',
                        };
                    @endphp
                    <article class="list-card">
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: var(--space-3); flex-wrap: wrap;">
                            <h3 style="font-size: var(--text-sm); font-weight: 800; color: var(--color-gray-900); margin: 0;">{{ $pengajuan->program?->name ?? 'Pengajuan Layanan' }}</h3>
                            <span class="badge {{ $statusClass }}">{{ $label }}</span>
                        </div>
                        <p class="stat-note" style="margin-top: var(--space-3); line-height: 1.6;">
                            @if($pengajuan->notes)
                                <strong>Catatan:</strong> {{ $pengajuan->notes }}
                            @else
                                Tidak ada catatan dari petugas.
                            @endif
                        </p>
                        <span class="stat-note" style="display: block; margin-top: var(--space-2);">Diperbarui: {{ $pengajuan->updated_at->format('d M Y, H:i') }}</span>
                    </article>
                @empty
                    <div class="support-empty-state">
                        <span class="support-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                        </span>
                        <h3>Belum ada riwayat</h3>
                        <p>Belum ada riwayat layanan.</p>
                        <div style="margin-top: var(--space-5);">
                            <a href="{{ route('umkm.pengajuan.index') }}" class="btn btn-primary">Buat Pengajuan</a>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection
