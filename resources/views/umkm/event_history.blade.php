@extends('layouts.app')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand flex items-center gap-3">
        <div style="background: white; border-radius: var(--radius-sm); padding: 0.25rem;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        </div>
        <div>
            <div class="brand-title" style="font-size: 1rem; line-height: 1.1;">PORTAL UMKM</div>
            <div class="brand-subtitle" style="font-size: 0.65rem; color: rgba(255,255,255,0.7);">KABUPATEN BANDUNG</div>
        </div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('umkm.dashboard') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
            Beranda
        </a>
        <a href="{{ route('umkm.pengajuan.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
            Pengajuan Program
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item active" style="background-color: rgba(255,255,255,0.1); color: white;">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event &amp; Pelatihan
        </a>
        <a href="{{ route('reports.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
    </nav>
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.event') }}" style="color: var(--color-text-muted);">Event &amp; Pelatihan</a>
        <span style="margin: 0 0.5rem;">&#8250;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Riwayat</span>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">

    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Riwayat Event</h1>
            <p class="text-gray-500 text-sm mt-1">Daftar event dan pelatihan yang pernah Anda ikuti.</p>
        </div>
        <a href="{{ route('umkm.event') }}" class="btn" style="background-color: var(--color-border); color: var(--color-gray-900);">Kembali ke Event</a>
    </div>

    @forelse ($registrations as $registration)
        <div class="card" style="padding: var(--space-5);">
            <div class="flex justify-between items-start">
                <div style="flex: 1;">
                    <div style="font-size: var(--text-xs); font-weight: 600; text-transform: uppercase; color: var(--color-secondary); margin-bottom: var(--space-1);">{{ ucfirst($registration->event->type ?? 'Event') }}</div>
                    <div style="font-size: var(--text-base); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-2);">{{ $registration->event->title ?? '-' }}</div>
                    <div style="font-size: var(--text-sm); color: var(--color-text-muted);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; margin-right: 4px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        {{ optional($registration->event->event_date)->format('d M Y, H:i') ?? '-' }}
                        &nbsp;&bull;&nbsp;
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:inline; margin-right: 4px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        {{ $registration->event->location ?? '-' }}
                    </div>
                    <div style="margin-top: var(--space-3);">
                        <span style="font-size: 0.75rem; padding: 0.25rem 0.5rem; border-radius: 999px; background-color: {{ $registration->status == 'approved' ? '#dcfce7' : ($registration->status == 'rejected' ? '#fee2e2' : '#fef3c7') }}; color: {{ $registration->status == 'approved' ? '#166534' : ($registration->status == 'rejected' ? '#991b1b' : '#92400e') }}; font-weight: 600;">
                            Status: {{ ucfirst($registration->status ?? 'Pending') }}
                        </span>
                    </div>
                </div>
                @if($registration->event)
                <a href="{{ route('umkm.event.show', $registration->event) }}" class="btn" style="background-color: var(--color-border); color: var(--color-primary); margin-left: var(--space-4); white-space: nowrap; font-size: var(--text-sm);">
                    Detail Event
                </a>
                @endif
            </div>
        </div>
    @empty
        <div class="card" style="padding: var(--space-12); text-align: center;">
            <div style="color: var(--color-text-muted); margin-bottom: var(--space-2);">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display: inline-block;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </div>
            <div style="font-size: var(--text-base); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada riwayat</div>
            <div style="font-size: var(--text-sm); color: var(--color-text-muted);">Anda belum berpartisipasi dalam event atau pelatihan manapun.</div>
        </div>
    @endforelse

</div>
@endsection
