@extends('layouts.app')

@section('title', 'Notifikasi & Riwayat - Portal UMKM')

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
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg></span>
            Edukasi
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
        <a href="{{ route('umkm.faq') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></span>
            FAQ & Bantuan
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
        Beranda <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Notifikasi & Riwayat Status</span>
    </div>
    <div class="flex items-center gap-6">
        <a href="{{ route('umkm.notifikasi') }}" class="text-primary hover:text-blue-700">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </a>
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()?->name ?? 'Pemilik Usaha' }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">{{ Auth::user()?->role ?? 'UMKM' }}</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()?->name ?? 'Pemilik Usaha') }}&background=ef4444&color=fff&rounded=true" alt="Avatar" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6" style="max-width: 64rem; margin: 0 auto;">
    
    <!-- Kolom Notifikasi -->
    <div class="card p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Semua Notifikasi</h2>
        
        <div class="flex flex-col gap-4">
            @forelse ($notifications ?? [] as $notif)
                <div class="p-4 rounded-lg" style="background-color: {{ $notif['is_read'] ? '#f8fafc' : '#eff6ff' }}; border: 1px solid {{ $notif['is_read'] ? 'var(--color-border)' : '#bfdbfe' }};">
                    <div class="flex justify-between items-start mb-2">
                        <div class="font-bold text-gray-900 text-sm">{{ $notif['title'] }}</div>
                        <div class="text-xs text-gray-500">{{ $notif['created_at'] }}</div>
                    </div>
                    <p class="text-sm text-gray-600">{{ $notif['message'] }}</p>
                </div>
            @empty
                <div class="text-center py-8">
                    <div class="text-gray-400 mb-2 flex justify-center">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                    </div>
                    <p class="text-gray-500">Belum ada notifikasi.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Kolom Riwayat Status -->
    <div class="card p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Riwayat Perubahan Status</h2>
        
        <div class="flex flex-col gap-6 relative">
            <div style="position: absolute; left: 15px; top: 15px; bottom: 15px; width: 2px; background-color: var(--color-border); z-index: 0;"></div>
            
            @forelse ($statusLogs ?? [] as $log)
                <div class="flex gap-4 relative z-10">
                    <div style="width: 32px; height: 32px; flex-shrink: 0; border-radius: 50%; background-color: var(--color-bg); border: 2px solid var(--color-primary); display: flex; align-items: center; justify-content: center; color: var(--color-primary);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                    </div>
                    <div>
                        <div class="font-bold text-gray-900 text-sm">{{ $log['status'] }}</div>
                        <p class="text-xs text-gray-600 mt-1">{{ $log['catatan'] ?? 'Status pengajuan diperbarui.' }}</p>
                        <div class="text-xs text-gray-400 font-medium mt-1">{{ $log['created_at'] }}</div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8 relative z-10" style="background-color: white;">
                    <p class="text-gray-500 text-sm">Belum ada riwayat status pengajuan. <a href="#" class="text-primary hover:underline">Mulai sekarang</a></p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
