@extends('layouts.app')

@section('title', 'Verifikasi UMKM')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('dinas.dashboard') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></span>
            Beranda
        </a>
        <a href="{{ route('dinas.verification.index') }}" class="nav-item active">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Verifikasi UMKM
        </a>
        <a href="{{ route('dinas.program.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span>
            Kelola Program
        </a>
        <a href="{{ route('dinas.pengajuan.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Approval Pengajuan
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
<header class="main-header">
    <div class="page-title">Verifikasi UMKM</div>
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
<div class="flex flex-col gap-6">

    @if (session('success'))
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-6);">
            Menunggu Verifikasi
            <span style="font-size: var(--text-sm); font-weight: 500; color: var(--color-text-muted); margin-left: var(--space-2);">{{ $pending->count() }} UMKM</span>
        </div>

        @forelse ($pending as $user)
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4); margin-bottom: var(--space-3); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-weight: 600; font-size: var(--text-sm); color: var(--color-gray-900);">{{ $user->name }}</div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $user->email }}</div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 2px;">Daftar: {{ $user->created_at->format('d M Y') }}</div>
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('dinas.verification.verify', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-primary" style="font-size: var(--text-xs); padding: var(--space-2) var(--space-3);" onclick="return confirm('Verifikasi UMKM ini?')">
                            Verifikasi
                        </button>
                    </form>
                    <form action="{{ route('dinas.verification.reject', $user) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" style="font-size: var(--text-xs); padding: var(--space-2) var(--space-3); background-color: var(--color-danger); color: white; border-radius: var(--radius-md); border: none; cursor: pointer;" onclick="return confirm('Tolak verifikasi UMKM ini?')">
                            Tolak
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: var(--space-8) 0; color: var(--color-text-muted); font-size: var(--text-sm);">
                Tidak ada UMKM yang menunggu verifikasi.
            </div>
        @endforelse
    </div>

    <div class="card" style="padding: var(--space-6);">
        <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-4);">
            Sudah Diverifikasi
            <span style="font-size: var(--text-sm); font-weight: 500; color: var(--color-text-muted); margin-left: var(--space-2);">{{ $verified->count() }} UMKM</span>
        </div>
        @forelse ($verified as $user)
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4); margin-bottom: var(--space-3); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-weight: 600; font-size: var(--text-sm); color: var(--color-gray-900);">{{ $user->name }}</div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $user->email }}</div>
                </div>
                <span class="badge" style="background-color: var(--color-success-bg); color: var(--color-success);">Terverifikasi</span>
            </div>
        @empty
            <div style="text-align: center; padding: var(--space-4) 0; color: var(--color-text-muted); font-size: var(--text-sm);">Belum ada.</div>
        @endforelse
    </div>

</div>
@endsection
