@extends('layouts.app')

@section('sidebar')
<!-- Sidebar uses a light variant "sidebar-light" for the Event page -->
<aside class="sidebar sidebar-light text-sm" style="flex-direction: column;">
    <div class="sidebar-brand">
        <div class="brand-title">Portal UMKM</div>
        <div class="brand-subtitle" style="font-weight: 500; font-size: 0.65rem; text-transform: uppercase;">BIROKRASI MODERN</div>
    </div>
    
    <nav class="nav-menu" style="flex: 1;">
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></span>
            Beranda
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg></span>
            Jadwal Pelatihan
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item active">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event Terdaftar
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg></span>
            Konsultasi
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>
            Pengaturan
        </a>
    </nav>
    
    <!-- Bottom User Profile Card -->
    <div style="padding: var(--space-4);">
        <div class="user-card-bottom">
            <div class="user-avatar" style="width: 2rem; height: 2rem; background-color: #0f172a; font-size: 0.8rem;">
                BS
            </div>
            <div class="user-info">
                <div class="user-name" style="font-size: 0.75rem;">Budi Santoso</div>
                <div class="user-role" style="font-size: 0.6rem; text-transform:none;">Wirausaha Mandiri</div>
            </div>
        </div>
        <div class="mt-4">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button class="btn w-full text-red-600 border border-red-200 bg-red-50 hover:bg-red-100" style="padding: 0.5rem; justify-content: center;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Keluar</button>
        </div>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header" style="height: 4.5rem; justify-content: space-between; border-bottom: none;">
    <div style="display: flex; flex-direction:column; gap: 0.125rem;">
        <h1 class="page-title" style="color: var(--color-gray-900); font-size: 1.125rem;">Detail Event</h1>
        <div style="color: var(--color-text-muted); font-size: 0.65rem; font-weight: 700; text-transform: uppercase;">
            <a href="{{ route('umkm.event') }}" class="hover:text-primary">Event &amp; Pelatihan</a> &gt; <span style="color: var(--color-primary);">Pelatihan Digital Marketing Tingkat Lanjut</span>
        </div>
    </div>
    
    <div class="flex items-center gap-6">
        <a href="{{ route('umkm.event') }}" class="btn bg-white border border-gray-200 text-gray-700 hover:bg-gray-50 flex items-center gap-2">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            Kembali ke Daftar
        </a>
    </div>
</header>
@endsection

@section('content')
<div class="flex gap-6" style="max-width: 64rem; margin: 0 auto; padding-top: 0;">
    
    <!-- Main Detail Area -->
    <div class="flex-1 flex flex-col gap-6">
        
        <!-- Hero Banner -->
        <div class="card p-0 overflow-hidden relative shadow-sm" style="height: 250px; background: #0b1a30;">
            <!-- Abstract mock texture -->
            <div style="position:absolute; inset:0; background: linear-gradient(135deg, rgba(14,165,233,0.4) 0%, rgba(2,132,199,0.2) 100%);"></div>
            <div class="absolute" style="top: 1.5rem; left: 1.5rem;">
                <span style="background-color: #dcfce7; color: #166534; padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.05em;">PELATIHAN</span>
            </div>
            <div class="absolute" style="bottom: 0; left: 0; width: 100%; padding: 2rem 1.5rem; background: linear-gradient(to top, rgba(15,23,42,0.9), transparent);">
                <h2 class="text-2xl font-bold text-white mb-2">Pelatihan Digital Marketing Tingkat Lanjut</h2>
                <div class="flex items-center gap-4 text-sm text-gray-200">
                    <span class="flex items-center gap-1">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        15 Nov 2024
                    </span>
                    <span class="flex items-center gap-1">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        09:00 - 15:00 WIB
                    </span>
                </div>
            </div>
        </div>

        <!-- Description -->
        <div class="card p-6 shadow-sm">
            <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-border pb-2">Deskripsi Kegiatan</h3>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                Pelajari strategi optimasi SEO, Meta Ads, dan Content Marketing secara mendalam untuk meningkatkan omzet penjualan produk UMKM Anda. Pelatihan ini dirancang khusus bagi pelaku UMKM yang sudah memiliki dasar penggunaan media sosial untuk bisnis dan ingin beralih ke strategi pemasaran berbayar (paid marketing) yang efektif.
            </p>
            <p class="text-gray-600 text-sm leading-relaxed">
                Mentor berpengalaman dari berbagai agensi digital terkemuka akan membimbing Anda secara langsung. Diharapkan peserta membawa produk masing-masing untuk sesi praktik foto produk dan pembuatan konten promosi.
            </p>

            <h3 class="text-lg font-bold text-gray-900 mt-8 mb-4 border-b border-border pb-2">Materi yang Dipelajari</h3>
            <ul class="list-disc pl-5 text-sm text-gray-600 flex flex-col gap-2">
                <li>Fondasi Digital Marketing untuk Skala Mikro</li>
                <li>Riset Keyword dan Optimasi SEO Dasar</li>
                <li>Setup dan Strategi Meta Ads (Facebook &amp; Instagram Ads)</li>
                <li>Copywriting untuk Landing Page Penjualan</li>
                <li>Evaluasi Metrik dan ROI Iklan</li>
            </ul>
        </div>
    </div>

    <!-- Side Panel (Info & Action) -->
    <div class="flex flex-col gap-6" style="width: 320px;">
        <div class="card p-6 shadow-sm border border-gray-100">
            <div class="mb-6">
                <div class="flex justify-between items-end mb-2">
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">KETERSEDIAAN KUOTA</span>
                    <span class="text-sm font-bold text-gray-900">45 / 50 <span class="text-gray-400 font-medium">Peserta</span></span>
                </div>
                <div class="progress-bar-bg" style="height: 8px;">
                    <div class="progress-bar-fill" style="width: 90%; background-color: var(--color-primary);"></div>
                </div>
                <p class="text-xs text-orange-600 mt-2 font-medium bg-orange-50 p-2 rounded border border-orange-100 text-center">
                    Sisa 5 kursi lagi! Segera daftar.
                </p>
            </div>

            <button class="btn btn-primary w-full py-3 text-base shadow-md hover:shadow-lg transition-all" style="justify-content: center;">
                Daftar Sekarang
            </button>
            <p class="text-center text-xs text-gray-400 mt-3">Pendaftaran ditutup pada 10 Nov 2024</p>
        </div>

        <div class="card p-6 shadow-sm">
            <h3 class="text-sm font-bold text-gray-900 mb-4 uppercase tracking-wide">Informasi Pelaksanaan</h3>
            
            <div class="flex flex-col gap-4">
                <div class="flex gap-3">
                    <div class="text-primary mt-0.5">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Lokasi</div>
                        <div class="text-xs text-gray-600 leading-relaxed mt-1">Balai Desa Soreang<br>Jl. Raya Soreang No. 12, Kab. Bandung, Jawa Barat</div>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <div class="text-primary mt-0.5">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Pemateri</div>
                        <div class="text-xs text-gray-600 mt-1">Bpk. Ahmad Fauzan (Digital Strategist)</div>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <div class="text-primary mt-0.5">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900">Persyaratan Khusus</div>
                        <div class="text-xs text-gray-600 leading-relaxed mt-1">
                            - Membawa laptop sendiri<br>
                            - Usaha sudah berjalan min. 1 tahun<br>
                            - Memiliki akun IG Bisnis aktif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
