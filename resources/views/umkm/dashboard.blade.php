@extends('layouts.app')

@section('sidebar')
<!-- The UMKM Dashboard uses the same Dark Blue sidebar, but different menu items, as it matches Image 4 -->
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
        <a href="#" class="nav-item">
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
        <a href="#" class="nav-item">
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
    </nav>
    
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Beranda <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Dashboard Utama</span>
    </div>
    <div class="flex items-center gap-6">
        <button class="text-gray-400 hover:text-gray-600">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </button>
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">Budi Santoso</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <!-- mock user photo from image 4 -->
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=ef4444&color=fff&rounded=true" alt="Budi" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">

    <!-- Warning Banner -->
    <div class="card p-0" style="background-color: #fefce8; border-color: transparent;">
        <div class="flex items-center justify-between" style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-warning);">
            <div class="flex items-center gap-4">
                <div style="background-color: rgba(245,158,11,0.2); padding: 0.5rem; border-radius: var(--radius-sm); color: var(--color-warning);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-gray-900 mb-1" style="color: #854d0e;">Profil Anda belum diverifikasi</h3>
                    <p class="text-sm" style="color: #a16207;">Lengkapi data usaha untuk mulai mengajukan bantuan permodalan dan pelatihan eksklusif.</p>
                </div>
            </div>
            <button class="btn" style="background-color: #d97706; color: white; padding: 0.5rem 1.25rem;">Lengkapi Profil</button>
        </div>
    </div>

    <!-- Stats Row -->
    <div class="grid grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="card p-6 flex gap-4 items-center" style="padding: var(--space-5);">
            <div style="background-color: #f1f5f9; padding: 0.75rem; border-radius: var(--radius-md); color: var(--color-primary);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><polyline points="9 15 11 17 15 12"></polyline></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">TOTAL PENGAJUAN</div>
                <div class="text-3xl font-bold text-gray-900 text-primary">2</div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="card p-6 flex gap-4 items-center" style="padding: var(--space-5);">
            <div style="background-color: var(--color-success-bg); padding: 0.75rem; border-radius: var(--radius-md); color: var(--color-success);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">EVENT DIIKUTI</div>
                <div class="text-3xl font-bold text-success" style="color: var(--color-success);">1</div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="card p-6 flex gap-4 items-center" style="padding: var(--space-5);">
            <div style="background-color: #faf5ff; padding: 0.75rem; border-radius: var(--radius-md); color: #9333ea;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">LAPORAN TERKIRIM</div>
                <div class="text-3xl font-bold" style="color: #9333ea;">3</div>
            </div>
        </div>
    </div>

    <!-- Split Content Row -->
    <div class="grid grid-cols-2 gap-6">
        <!-- left chart (span 1) -->
        <div class="card p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900">Status Pengajuan Program</h3>
                <button class="text-gray-400 hover:text-gray-600"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
            </div>

            <div class="flex justify-center items-center py-6 mb-4">
                <!-- SVG Semi-circle ring Chart Mock -->
                <div style="position: relative; width: 180px; height: 180px;">
                    <svg viewBox="0 0 36 36" style="width: 100%; height: 100%; transform: rotate(-90deg);">
                        <!-- Bg circle -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#f1f5f9" stroke-width="3" stroke-dasharray="100, 100"></path>
                        <!-- Menunggu (orange/yellow) ~50% -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#f59e0b" stroke-width="3" stroke-dasharray="50, 100" stroke-linecap="round"></path>
                        <!-- Disetujui (blue) ~50% (but offset by 50) -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#1e40af" stroke-width="3" stroke-dasharray="50, 100" stroke-dashoffset="-50" stroke-linecap="round"></path>
                    </svg>
                    <!-- Text inside -->
                    <div style="position: absolute; top:0; left:0; width:100%; height:100%; display: flex; flex-direction:column; align-items:center; justify-content:center;">
                        <span style="font-weight: 800; font-size: 2.5rem; text-shadow: 0px 2px 4px rgba(0,0,0,0.1); color: var(--color-gray-900);">2</span>
                        <span style="font-size: 0.65rem; color: var(--color-text-muted); font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase;">TOTAL</span>
                    </div>
                </div>
            </div>

            <!-- Legends -->
            <div class="grid grid-cols-3 gap-0 mt-2 text-center border-t border-gray-100 pt-6">
                <div>
                    <div class="flex items-center justify-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-widest mb-1"><div style="width: 6px; height: 6px; background: #f59e0b; border-radius: 50%;"></div>Menunggu</div>
                    <div class="text-xl font-bold text-gray-900">1</div>
                </div>
                <div>
                    <div class="flex items-center justify-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-widest mb-1"><div style="width: 6px; height: 6px; background: #1e40af; border-radius: 50%;"></div>Disetujui</div>
                    <div class="text-xl font-bold text-gray-900">1</div>
                </div>
                <div>
                    <div class="flex items-center justify-center gap-2 text-xs font-bold text-gray-500 uppercase tracking-widest mb-1"><div style="width: 6px; height: 6px; background: #cbd5e1; border-radius: 50%;"></div>Ditolak</div>
                    <div class="text-xl font-bold text-gray-900">0</div>
                </div>
            </div>
        </div>

        <!-- right card (span 1 - notifications timeline) -->
        <div class="card p-6 flex flex-col">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900">Notifikasi Terbaru</h3>
                <a href="#" class="text-sm font-semibold hover:underline" style="color: var(--color-primary);">Lihat Semua</a>
            </div>
            
            <div class="flex flex-col gap-6 relative flex-1">
                <!-- connector line -->
                <div style="position: absolute; left: 15px; top: 15px; bottom: 15px; width: 2px; background-color: var(--color-bg); z-index: 0;"></div>
                
                <!-- Notif 1 -->
                <div class="flex gap-4 relative z-10 w-full">
                    <div style="width: 32px; height: 32px; flex-shrink: 0; border-radius: 50%; background-color: var(--color-info-bg); color: var(--color-secondary); display: flex; align-items: center; justify-content: center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    </div>
                    <div>
                        <div class="font-bold text-gray-900 text-sm mb-1">Pengajuan Dana KUR Tahap 1 Sedang Diverifikasi</div>
                        <p class="text-xs text-gray-500 mb-1 leading-relaxed">Admin Dinas Koperasi &amp; UMKM sedang melakukan peninjauan dokumen administrasi Anda.</p>
                        <div class="text-xs text-gray-400 font-medium">15 menit yang lalu</div>
                    </div>
                </div>
                
                <!-- Notif 2 -->
                <div class="flex gap-4 relative z-10 w-full">
                    <div style="width: 32px; height: 32px; flex-shrink: 0; border-radius: 50%; background-color: var(--color-success-bg); color: var(--color-success); display: flex; align-items: center; justify-content: center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    </div>
                    <div>
                        <div class="font-bold text-gray-900 text-sm mb-1">Laporan Perkembangan Oktober Disetujui</div>
                        <p class="text-xs text-gray-500 mb-1 leading-relaxed">Laporan omzet bulanan Anda telah divalidasi dan masuk ke basis data provinsi.</p>
                        <div class="text-xs text-gray-400 font-medium">3 jam yang lalu</div>
                    </div>
                </div>

                <!-- Notif 3 -->
                <div class="flex gap-4 relative z-10 w-full">
                    <div style="width: 32px; height: 32px; flex-shrink: 0; border-radius: 50%; background-color: #fef3c7; color: #d97706; display: flex; align-items: center; justify-content: center;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    </div>
                    <div>
                        <div class="font-bold text-gray-900 text-sm mb-1">Undangan Pelatihan Pemasaran Digital</div>
                        <p class="text-xs text-gray-500 mb-1 leading-relaxed">Terdapat pelatihan baru untuk UMKM sektor kuliner di Balai Desa Soreang besok.</p>
                        <div class="text-xs text-gray-400 font-medium">Kemarin, 09:30</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Row -->
    <div class="card p-0 overflow-hidden mb-6">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <div>
                <h3 class="font-bold text-gray-900 text-lg">Laporan Perkembangan Terakhir</h3>
                <p class="text-sm text-gray-500">Data kinerja operasional usaha 3 periode terakhir</p>
            </div>
            <div>
                <button class="btn" style="background-color: var(--color-border); color: var(--color-primary); display: flex; align-items: center; gap: 0.5rem; border-radius: var(--radius-md);">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Buat Laporan Baru
                </button>
            </div>
        </div>
        
        <div class="table-container p-6 pt-0">
            <table class="table" style="margin-top: -1px;">
                <thead>
                    <tr>
                        <th style="padding-top: var(--space-4);">PERIODE</th>
                        <th style="padding-top: var(--space-4);">DESKRIPSI</th>
                        <th style="padding-top: var(--space-4);">OMZET</th>
                        <th style="padding-top: var(--space-4); text-align: right;">STATUS EVALUASI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-bold text-gray-900">Oktober 2023</td>
                        <td class="text-gray-600">Peningkatan produksi kerajinan anyaman</td>
                        <td class="font-bold text-gray-900">Rp 12.500.000</td>
                        <td style="text-align: right;">
                            <span style="display:inline-flex; align-items:center; background-color: var(--color-success-bg); color: var(--color-success); font-size: 0.65rem; font-weight: 800; padding: 0.25rem 0.6rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                + SANGAT BAIK
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-bold text-gray-900">September 2023</td>
                        <td class="text-gray-600">Fokus pada perluasan pasar online</td>
                        <td class="font-bold text-gray-900">Rp 10.200.000</td>
                        <td style="text-align: right;">
                            <span style="display:inline-flex; align-items:center; background-color: var(--color-info-bg); color: var(--color-secondary); font-size: 0.65rem; font-weight: 800; padding: 0.25rem 0.6rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                + TERVALIDASI
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="font-bold text-gray-900">Agustus 2023</td>
                        <td class="text-gray-600">Restrukturisasi tim operasional</td>
                        <td class="font-bold text-gray-900">Rp 8.900.000</td>
                        <td style="text-align: right;">
                            <span style="display:inline-flex; align-items:center; background-color: var(--color-info-bg); color: var(--color-secondary); font-size: 0.65rem; font-weight: 800; padding: 0.25rem 0.6rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                + TERVALIDASI
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="mt-6 mb-2 text-center">
                <a href="#" class="text-sm font-bold hover:underline" style="color: var(--color-primary);">Tampilkan Riwayat Lengkap</a>
            </div>
        </div>
    </div>
    
    <div class="text-center text-xs text-gray-400 font-medium pb-8">
        &copy; 2023 Pemerintah Kabupaten Bandung - Dinas Koperasi &amp; UMKM.
    </div>

</div>
@endsection
