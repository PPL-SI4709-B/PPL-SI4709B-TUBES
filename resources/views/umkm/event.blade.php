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
        <a href="#" class="nav-item active">
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
            <button class="btn btn-primary w-full" style="padding: 0.5rem; justify-content: center;">Cari Pelatihan</button>
        </div>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header" style="height: 4.5rem; justify-content: space-between; border-bottom: none;">
    <div style="display: flex; flex-direction:column; gap: 0.125rem;">
        <h1 class="page-title" style="color: var(--color-gray-900); font-size: 1.125rem;">Event &amp; Pelatihan</h1>
        <div style="color: var(--color-text-muted); font-size: 0.65rem; font-weight: 700; text-transform: uppercase;">Beranda &gt; <span style="color: var(--color-primary);">Event &amp; Pelatihan</span></div>
    </div>
    
    <div class="flex items-center gap-6">
        <div class="relative" style="width: 300px;">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </span>
            <input type="text" placeholder="Cari layanan..." style="width: 100%; padding: 0.5rem 1rem 0.5rem 2.25rem; font-size: 0.875rem; border-radius: 99px; border: none; background-color: #f1f5f9; outline: none; font-weight: 500;">
        </div>
        
        <button class="text-gray-400 hover:text-gray-600">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </button>
        <button class="text-gray-400 hover:text-gray-600">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
        </button>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto; padding-top: 0;">

    <!-- Tabs -->
    <div style="display: flex; gap: var(--space-6); border-bottom: 1px solid var(--color-border); margin-bottom: var(--space-6);">
        <div style="padding-bottom: var(--space-3); border-bottom: 2px solid var(--color-primary); color: var(--color-primary); font-weight: 700; font-size: 0.875rem; cursor: pointer;">Event Tersedia</div>
        <div style="padding-bottom: var(--space-3); color: var(--color-text-muted); font-weight: 600; font-size: 0.875rem; cursor: pointer;">Riwayat Kegiatan Saya</div>
    </div>

    <!-- Filter Bar -->
    <div class="flex justify-between items-center bg-white p-2 rounded-lg" style="box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding-right: 1.5rem;">
        <div class="flex gap-4 w-1/2" style="width: 60%;">
            <div class="relative w-full" style="flex: 1;">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </span>
                <input type="text" placeholder="Cari event..." style="width: 100%; padding: 0.6rem 1rem 0.6rem 2.25rem; font-size: 0.875rem; border-radius: var(--radius-md); border: none; background-color: #f8fafc; outline: none;">
            </div>
            <div class="relative" style="width: 180px;">
                <select style="width: 100%; padding: 0.6rem 2.25rem 0.6rem 1rem; font-size: 0.875rem; border-radius: var(--radius-md); border: none; background-color: #f8fafc; outline: none; appearance: none; font-weight: 500; font-family: inherit;">
                    <option>Semua Kategori</option>
                </select>
                <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-500">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
        </div>
        
        <div class="flex items-center gap-3">
            <div style="width: 40px; height: 20px; background-color: var(--color-primary); border-radius: 99px; position: relative;">
                <div style="width: 16px; height: 16px; background-color: white; border-radius: 50%; position: absolute; top: 2px; right: 2px;"></div>
            </div>
            <span style="font-size: 0.875rem; font-weight: 600; color: var(--color-gray-800);">Tampilkan yang masih tersedia saja</span>
        </div>
    </div>

    <!-- Event Cards Grid -->
    <div class="grid grid-cols-2 gap-6 mt-2">
        
        <!-- Card 1 -->
        <div class="card p-0 overflow-hidden relative shadow-sm" style="display: flex; flex-direction: column;">
            <!-- Header Image -->
            <div style="height: 180px; position: relative; background: #0b1a30; overflow: hidden;">
                <!-- Abstract mock texture -->
                <div style="position:absolute; inset:0; background: linear-gradient(135deg, rgba(14,165,233,0.3) 0%, rgba(2,132,199,0.1) 100%);"></div>
                <div style="position:absolute; inset:0; opacity:0.2;">
                    <!-- Some mock dots for map -->
                </div>
                
                <div class="absolute" style="top: 1rem; left: 1rem;">
                    <span style="background-color: #dcfce7; color: #166534; padding: 0.25rem 0.6rem; border-radius: 99px; font-size: 0.65rem; font-weight: 800; letter-spacing: 0.05em;">PELATIHAN</span>
                </div>
            </div>
            
            <!-- Body -->
            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Pelatihan Digital Marketing Tingkat Lanjut</h3>
                <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed mb-6 flex-1">Pelajari strategi optimasi SEO, Meta Ads, dan Content Marketing secara mendalam untuk meningkatkan omzet penjualan.</p>
                
                <div class="flex flex-col gap-2 mb-6">
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        15 Nov 2024
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Balai Desa Soreang, Bandung
                    </div>
                </div>

                <div class="mb-5">
                    <div class="flex justify-between items-end mb-1">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wide" style="font-size: 0.65rem;">KETERSEDIAAN KUOTA</span>
                        <span class="text-xs font-bold text-gray-900">45 / 50 <span class="text-gray-400 font-medium">Peserta</span></span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 90%;"></div>
                    </div>
                </div>

                <button class="btn btn-primary w-full" style="justify-content: center; padding: 0.75rem;">Daftar Sekarang</button>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card p-0 overflow-hidden relative shadow-sm" style="display: flex; flex-direction: column;">
            <!-- Header Image -->
            <div style="height: 180px; position: relative; background: #64748b; overflow: hidden;">
                <div class="absolute" style="top: 1rem; left: 1rem;">
                    <span style="background-color: #f1f5f9; color: #475569; padding: 0.25rem 0.6rem; border-radius: 99px; font-size: 0.65rem; font-weight: 800; letter-spacing: 0.05em;">SEMINAR</span>
                </div>
            </div>
            
            <!-- Body -->
            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Seminar Akses Permodalan UMKM</h3>
                <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed mb-6 flex-1">Sosialisasi kemudahan akses KUR dan bantuan modal usaha dari lembaga perbankan resmi untuk skala mikro.</p>
                
                <div class="flex flex-col gap-2 mb-6">
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        20 Nov 2024
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Aula Dinas Koperasi, Soreang
                    </div>
                </div>

                <div class="mb-5">
                    <div class="flex justify-between items-end mb-1">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wide" style="font-size: 0.65rem;">KETERSEDIAAN KUOTA</span>
                        <span class="text-xs font-bold text-red-600" style="color: #dc2626;">Penuh</span>
                    </div>
                    <div class="progress-bar-bg" style="background-color: var(--color-border);">
                        <div class="progress-bar-fill" style="width: 100%; background-color: var(--color-border);"></div>
                    </div>
                </div>

                <button class="btn btn-outline w-full" style="justify-content: center; padding: 0.75rem; background-color: #f1f5f9; border-color: #e2e8f0; color: #64748b; cursor: not-allowed;">Penuh</button>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="card p-0 overflow-hidden relative shadow-sm" style="display: flex; flex-direction: column;">
            <!-- Header Image -->
            <div style="height: 180px; position: relative; background: #1e293b; overflow: hidden;">
                <div class="absolute" style="top: 1rem; left: 1rem;">
                    <span style="background-color: #ffedd5; color: #c2410c; padding: 0.25rem 0.6rem; border-radius: 99px; font-size: 0.65rem; font-weight: 800; letter-spacing: 0.05em;">WORKSHOP</span>
                </div>
            </div>
            
            <!-- Body -->
            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Workshop Packaging Kreatif</h3>
                <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed mb-6 flex-1">Tingkatkan nilai jual produk dengan kemasan yang estetik, ramah lingkungan, dan sesuai standar keamanan pangan.</p>
                
                <div class="flex flex-col gap-2 mb-6">
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        05 Dec 2024
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Gedung Sabilulungan
                    </div>
                </div>

                <div class="mb-5">
                    <div class="flex justify-between items-end mb-1">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wide" style="font-size: 0.65rem;">KETERSEDIAAN KUOTA</span>
                        <span class="text-xs font-bold text-gray-900">12 / 30 <span class="text-gray-400 font-medium">Peserta</span></span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 40%;"></div>
                    </div>
                </div>

                <button class="btn btn-primary w-full" style="justify-content: center; padding: 0.75rem;">Daftar Sekarang</button>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="card p-0 overflow-hidden relative shadow-sm" style="display: flex; flex-direction: column;">
            <!-- Header Image -->
            <div style="height: 180px; position: relative; background: #0f172a; overflow: hidden;">
                <div class="absolute" style="top: 1rem; left: 1rem;">
                    <span style="background-color: #f3e8ff; color: #7e22ce; padding: 0.25rem 0.6rem; border-radius: 99px; font-size: 0.65rem; font-weight: 800; letter-spacing: 0.05em;">PAMERAN</span>
                </div>
            </div>
            
            <!-- Body -->
            <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Pameran Produk Unggulan Daerah</h3>
                <p class="text-sm text-gray-500 line-clamp-2 leading-relaxed mb-6 flex-1">Kesempatan memamerkan produk terbaik Anda di hadapan ribuan pengunjung dan calon investor berskala nasional.</p>
                
                <div class="flex flex-col gap-2 mb-6">
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        12 Dec 2024
                    </div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-gray-600">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Lapangan Upakarti, Kab. Bandung
                    </div>
                </div>

                <div class="mb-5">
                    <div class="flex justify-between items-end mb-1">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wide" style="font-size: 0.65rem;">KETERSEDIAAN KUOTA</span>
                        <span class="text-xs font-bold text-gray-900">25 / 40 <span class="text-gray-400 font-medium">Peserta</span></span>
                    </div>
                    <div class="progress-bar-bg">
                        <div class="progress-bar-fill" style="width: 62.5%;"></div>
                    </div>
                </div>

                <button class="btn btn-primary w-full" style="justify-content: center; padding: 0.75rem;">Daftar Sekarang</button>
            </div>
        </div>

    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center gap-2 mt-6 mb-8">
        <button class="w-8 h-8 rounded flex items-center justify-center bg-gray-100 text-gray-400">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button class="w-8 h-8 rounded flex items-center justify-center bg-primary text-white font-semibold">1</button>
        <button class="w-8 h-8 rounded flex items-center justify-center text-gray-700 font-semibold hover:bg-gray-100">2</button>
        <button class="w-8 h-8 rounded flex items-center justify-center text-gray-700 font-semibold hover:bg-gray-100">3</button>
        <span class="text-gray-400">...</span>
        <button class="w-8 h-8 rounded flex items-center justify-center text-gray-700 font-semibold hover:bg-gray-100">12</button>
        <button class="w-8 h-8 rounded flex items-center justify-center bg-gray-100 text-gray-600">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
    </div>

    <div class="text-center text-xs text-gray-400 font-medium pb-8 border-t border-border pt-6 mx-8">
        &copy; 2024 Pemerintah Kabupaten Bandung. Semua Hak Dilindungi.
    </div>
</div>
@endsection
