@extends('layouts.app')

@section('title', 'Kelola Event')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('dinas.dashboard') }}" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </span>
            Beranda
        </a>
        <a href="{{ route('dinas.event.index') }}" class="nav-item active">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </span>
            Kelola Event
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Kelola Event</div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()?->name }}</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">

    @if (session('success'))
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-center mb-6">
            <div>
                <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900);">Daftar Event</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">{{ $events->total() }} event terdaftar</div>
            </div>
            <a href="{{ route('dinas.event.create') }}" class="btn btn-primary">
                + Tambah Event
            </a>
        </div>

        @forelse ($events as $event)
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-5); margin-bottom: var(--space-3);">
                <div class="flex justify-between items-start">
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: var(--text-sm); color: var(--color-gray-900);">{{ $event->title }}</div>
                        @if ($event->description)
                            <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 4px;">{{ Str::limit($event->description, 100) }}</div>
                        @endif
                        <div class="flex gap-4 mt-3" style="font-size: var(--text-xs); color: var(--color-text-muted);">
                            <span>Tanggal: <strong>{{ $event->event_date?->format('d M Y, H:i') }}</strong></span>
                            <span>Lokasi: <strong>{{ $event->location }}</strong></span>
                            <span>Kuota: <strong>{{ $event->quota }}</strong></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 ml-4">
                        @php
                            $statusBg = '#f1f5f9';
                            $statusColor = 'var(--color-text-muted)';
                            if ($event->status === 'active') {
                                $statusBg = 'var(--color-success-bg)';
                                $statusColor = 'var(--color-success)';
                            }
                        @endphp
                        <span class="badge" style="background-color: {{ $statusBg }}; color: {{ $statusColor }};">
                            {{ $event->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <a href="{{ route('dinas.event.edit', $event) }}" style="font-size: var(--text-sm); color: var(--color-secondary); font-weight: 500;">Edit</a>
                        <form action="{{ route('dinas.event.destroy', $event) }}" method="POST" onsubmit="return confirm('Hapus event ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="font-size: var(--text-sm); color: var(--color-danger); font-weight: 500; background: none; border: none; cursor: pointer;">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: var(--space-12) 0; color: var(--color-text-muted);">
                <div style="font-size: var(--text-sm); margin-bottom: var(--space-3);">Belum ada event.</div>
                <a href="{{ route('dinas.event.create') }}" class="btn btn-primary">Tambah Event Pertama</a>
            </div>
        @endforelse

        @if ($events->hasPages())
            <div class="mt-4">
                {{ $events->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
