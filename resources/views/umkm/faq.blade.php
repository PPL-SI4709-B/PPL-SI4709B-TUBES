@extends('layouts.app')

@section('title', 'FAQ & Bantuan - Portal UMKM')

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
        <a href="{{ route('umkm.faq') }}" class="nav-item active">
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
        Beranda <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">FAQ & Bantuan</span>
    </div>
    <div class="flex items-center gap-6">
        <button class="text-gray-400 hover:text-gray-600">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </button>
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
<div class="flex flex-col gap-6" style="max-width: 48rem; margin: 0 auto;">
    <div class="text-center mb-4">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">FAQ & Bantuan</h1>
        <p class="text-gray-600">Pertanyaan yang sering diajukan mengenai penggunaan Portal UMKM.</p>
    </div>

    <div class="card p-6 mb-4">
        <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Pengajuan Pendanaan</h2>
        
        <div class="mb-4">
            <h3 class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Bagaimana cara mengajukan pendanaan?
            </h3>
            <p class="text-gray-600 mt-2 pl-6 leading-relaxed">
                Anda dapat mengajukan pendanaan melalui menu "Pengajuan Program" di sidebar. Pastikan profil usaha Anda sudah lengkap dan diverifikasi oleh petugas sebelum mengajukan pendanaan.
            </p>
        </div>
        
        <div class="mb-4">
            <h3 class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Berapa lama proses persetujuan pengajuan pendanaan?
            </h3>
            <p class="text-gray-600 mt-2 pl-6 leading-relaxed">
                Proses verifikasi dan persetujuan pengajuan memakan waktu kurang lebih 5-7 hari kerja. Anda dapat memantau status pengajuan melalui fitur notifikasi atau halaman riwayat status.
            </p>
        </div>
    </div>

    <div class="card p-6 mb-4">
        <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Laporan Perkembangan</h2>
        
        <div class="mb-4">
            <h3 class="font-semibold text-gray-800 text-lg flex items-center gap-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-primary"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                Kapan saya harus mengirimkan laporan perkembangan usaha?
            </h3>
            <p class="text-gray-600 mt-2 pl-6 leading-relaxed">
                Laporan perkembangan usaha harus dikirimkan setiap kuartal (3 bulan sekali). Laporan tersebut meliputi kinerja operasional dan omzet usaha Anda.
            </p>
        </div>
    </div>

    <div class="card p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Kontak Dinas</h2>
        <div class="flex items-start gap-4">
            <div style="background-color: var(--color-primary-light); padding: 0.75rem; border-radius: var(--radius-md); color: var(--color-primary);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900">Dinas Koperasi & UMKM Kabupaten Bandung</h3>
                <p class="text-gray-600 mt-1">Jika Anda membutuhkan bantuan lebih lanjut, silakan hubungi kami:</p>
                <ul class="text-gray-600 mt-2 space-y-1">
                    <li><strong>Email:</strong> support@umkm-bandung.go.id</li>
                    <li><strong>Telepon:</strong> (022) 1234567</li>
                    <li><strong>Alamat:</strong> Jl. Raya Soreang Km. 17, Kabupaten Bandung</li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
