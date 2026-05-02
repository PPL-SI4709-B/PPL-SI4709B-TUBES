@extends('layouts.app')

@section('title', 'Buat Laporan - Portal UMKM')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand flex items-center gap-3">
        <div style="background: white; border-radius: var(--radius-sm); padding: 0.25rem;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
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
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Profil Usaha
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
            Pengajuan Program
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event &amp; Pelatihan
        </a>
        <a href="{{ route('reports.index') }}" class="nav-item active">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('reports.index') }}" style="color: var(--color-text-muted); text-decoration: none;">Laporan Perkembangan</a>
        <span style="margin: 0 0.5rem;">&#8250;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Buat Laporan Baru</span>
    </div>
    <div class="flex items-center gap-6">
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div style="max-width: 42rem; margin: 0 auto;">

    <div class="card p-0 overflow-hidden">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--color-border);">
            <h1 class="font-bold text-gray-900" style="font-size: 1.125rem;">Buat Laporan Perkembangan</h1>
            <p class="text-sm text-gray-500 mt-1">Laporan akan diteruskan ke Dinas untuk ditinjau dan diberi umpan balik.</p>
        </div>

        <form action="{{ route('reports.store') }}" method="POST" style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf

            <div>
                <label for="judul" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.375rem;">
                    Judul Laporan <span style="color: #dc2626;">*</span>
                </label>
                <input
                    id="judul"
                    type="text"
                    name="judul"
                    value="{{ old('judul') }}"
                    placeholder="Contoh: Laporan Perkembangan Usaha April 2026"
                    style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid {{ $errors->has('judul') ? '#dc2626' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: 0.875rem; outline: none; font-family: inherit;"
                >
                @error('judul')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deskripsi" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.375rem;">
                    Deskripsi Perkembangan Usaha <span style="color: #dc2626;">*</span>
                </label>
                <textarea
                    id="deskripsi"
                    name="deskripsi"
                    rows="6"
                    placeholder="Jelaskan perkembangan usaha Anda pada periode ini, termasuk pencapaian, kendala, dan rencana ke depan..."
                    style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid {{ $errors->has('deskripsi') ? '#dc2626' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: 0.875rem; outline: none; font-family: inherit; resize: vertical;"
                >{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 0.75rem; justify-content: flex-end; padding-top: 0.5rem; border-top: 1px solid var(--color-border);">
                <a href="{{ route('reports.index') }}" class="btn" style="background-color: var(--color-border); color: var(--color-text); border-radius: var(--radius-md);">
                    Batal
                </a>
                <button type="submit" id="submit-report" class="btn" style="background-color: var(--color-primary); color: white; border-radius: var(--radius-md);">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
