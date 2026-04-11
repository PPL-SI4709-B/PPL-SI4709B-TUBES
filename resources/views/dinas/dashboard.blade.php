@extends('layouts.app')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>
    
    <nav class="nav-menu">
        <a href="#" class="nav-item active">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </span>
            Beranda
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </span>
            Data UMKM
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            </span>
            Verifikasi Profil
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </span>
            Kelola Pengajuan
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            </span>
            Kelola Event
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
            </span>
            Kelola Edukasi
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            </span>
            Laporan UMKM
        </a>
        <a href="#" class="nav-item" style="margin-top: 1rem;">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
            </span>
            Master Data
        </a>
    </nav>
    
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Dashboard Dinas</div>
    <div class="flex items-center gap-6">
        <button class="text-gray-400 hover:text-gray-600">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
        </button>
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">Siti Rahayu</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                <img src="https://ui-avatars.com/api/?name=Siti+Rahayu&background=2563eb&color=fff" alt="Avatar">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">

    <!-- Stats Row -->
    <div class="grid grid-cols-4 gap-6">
        <!-- Card 1 -->
        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: #f1f5f9; padding: 0.5rem; border-radius: var(--radius-md); color: var(--color-primary);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="badge" style="background-color: var(--color-blue-100); color: var(--color-secondary);">+12%</div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">TOTAL UMKM TERDAFTAR</div>
            <div class="text-3xl font-bold text-gray-900">248</div>
        </div>
        
        <!-- Card 2 -->
        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: var(--color-success-bg); padding: 0.5rem; border-radius: var(--radius-md); color: var(--color-success);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <div class="badge" style="background-color: var(--color-success-bg); color: var(--color-success);">Stabil</div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">UMKM TERVERIFIKASI</div>
            <div class="text-3xl font-bold text-gray-900">195</div>
        </div>

        <!-- Card 3 -->
        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: #fff7ed; padding: 0.5rem; border-radius: var(--radius-md); color: #ea580c;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </div>
                <div class="badge" style="background-color: #ffedd5; color: #c2410c;">Urgent</div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">PENGAJUAN MASUK</div>
            <div class="text-3xl font-bold text-gray-900">12</div>
        </div>

        <!-- Card 4 -->
        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: #faf5ff; padding: 0.5rem; border-radius: var(--radius-md); color: #9333ea;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
                <div class="badge" style="background-color: #f3e8ff; color: #7e22ce;">Bulan Ini</div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">EVENT AKTIF</div>
            <div class="text-3xl font-bold text-gray-900">3</div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-3 gap-6">
        <!-- left chart (span 2) -->
        <div class="card col-span-2 p-6" style="grid-column: span 2 / span 2;">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h3 class="font-bold text-gray-900 mb-1">Distribusi UMKM per Kecamatan</h3>
                    <p class="text-sm text-gray-500">Data sebaran 6 wilayah tertinggi</p>
                </div>
                <div>
                    <button class="flex items-center gap-2 text-sm font-medium text-color-primary" style="color: var(--color-primary);">
                        Filter Wilayah
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                </div>
            </div>

            <div class="flex flex-col gap-5 mt-2">
                <!-- Bar 1 -->
                <div>
                    <div class="flex justify-between text-sm mb-2 font-medium">
                        <span class="text-gray-800">Soreang</span>
                        <span class="text-color-primary" style="color: var(--color-secondary);">84 Unit</span>
                    </div>
                    <div class="progress-bar-bg" style="height: 0.6rem; background-color: #f1f5f9;">
                        <div class="progress-bar-fill" style="width: 84%; border-radius: var(--radius-full);"></div>
                    </div>
                </div>
                <!-- Bar 2 -->
                <div>
                    <div class="flex justify-between text-sm mb-2 font-medium">
                        <span class="text-gray-800">Ciwidey</span>
                        <span class="text-color-primary" style="color: var(--color-secondary);">62 Unit</span>
                    </div>
                    <div class="progress-bar-bg" style="height: 0.6rem; background-color: #f1f5f9;">
                        <div class="progress-bar-fill" style="width: 62%; border-radius: var(--radius-full);"></div>
                    </div>
                </div>
                <!-- Bar 3 -->
                <div>
                    <div class="flex justify-between text-sm mb-2 font-medium">
                        <span class="text-gray-800">Margahayu</span>
                        <span class="text-color-primary" style="color: var(--color-secondary);">48 Unit</span>
                    </div>
                    <div class="progress-bar-bg" style="height: 0.6rem; background-color: #f1f5f9;">
                        <div class="progress-bar-fill" style="width: 48%; border-radius: var(--radius-full);"></div>
                    </div>
                </div>
                <!-- Bar 4 -->
                <div>
                    <div class="flex justify-between text-sm mb-2 font-medium">
                        <span class="text-gray-800">Baleendah</span>
                        <span class="text-color-primary" style="color: var(--color-secondary);">42 Unit</span>
                    </div>
                    <div class="progress-bar-bg" style="height: 0.6rem; background-color: #f1f5f9;">
                        <div class="progress-bar-fill" style="width: 42%; border-radius: var(--radius-full);"></div>
                    </div>
                </div>
                <!-- Bar 5 -->
                <div>
                    <div class="flex justify-between text-sm mb-2 font-medium">
                        <span class="text-gray-800">Dayeuhkolot</span>
                        <span class="text-color-primary" style="color: var(--color-secondary);">35 Unit</span>
                    </div>
                    <div class="progress-bar-bg" style="height: 0.6rem; background-color: #f1f5f9;">
                        <div class="progress-bar-fill" style="width: 35%; border-radius: var(--radius-full);"></div>
                    </div>
                </div>
                <!-- Bar 6 -->
                <div>
                    <div class="flex justify-between text-sm mb-2 font-medium">
                        <span class="text-gray-800">Majalaya</span>
                        <span class="text-color-primary" style="color: var(--color-secondary);">29 Unit</span>
                    </div>
                    <div class="progress-bar-bg" style="height: 0.6rem; background-color: #f1f5f9;">
                        <div class="progress-bar-fill" style="width: 29%; border-radius: var(--radius-full);"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- right chart (span 1) -->
        <div class="card p-6" style="grid-column: span 1 / span 1;">
            <h3 class="font-bold text-gray-900 mb-6">Distribusi Kategori Usaha</h3>
            
            <div class="flex justify-center items-center py-4 mb-2">
                <!-- SVG Donut Chart Mock -->
                <div style="position: relative; width: 140px; height: 140px;">
                    <svg viewBox="0 0 36 36" style="width: 100%; height: 100%; transform: rotate(-90deg);">
                        <!-- Bg circle -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#f1f5f9" stroke-width="4"></path>
                        <!-- blue (kuliner 40%) -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#003f88" stroke-width="4" stroke-dasharray="40, 100"></path>
                        <!-- fashion (20%) -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#2563eb" stroke-width="4" stroke-dasharray="20, 100" stroke-dashoffset="-40"></path>
                        <!-- perdagangan 15% -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#475569" stroke-width="4" stroke-dasharray="15, 100" stroke-dashoffset="-60"></path>
                        <!-- kerajinan 15% -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#93c5fd" stroke-width="4" stroke-dasharray="15, 100" stroke-dashoffset="-75"></path>
                        <!-- Jasa 10% -->
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#dbeafe" stroke-width="4" stroke-dasharray="10, 100" stroke-dashoffset="-90"></path>
                    </svg>
                    <!-- Text inside -->
                    <div style="position: absolute; top:0; left:0; width:100%; height:100%; display: flex; flex-direction:column; align-items:center; justify-content:center;">
                        <span style="font-weight: 800; font-size: 1.25rem;">100%</span>
                        <span style="font-size: 0.65rem; color: var(--color-text-muted); font-weight: 600; letter-spacing: 0.05em;">TOTAL</span>
                    </div>
                </div>
            </div>

            <!-- Legends -->
            <div class="grid grid-cols-2 gap-y-3 gap-x-2 mt-4 text-xs font-medium text-gray-600">
                <div class="flex items-center gap-2"><div style="width: 8px; height: 8px; background: #003f88; border-radius: 2px;"></div>Kuliner (40%)</div>
                <div class="flex items-center gap-2"><div style="width: 8px; height: 8px; background: #2563eb; border-radius: 2px;"></div>Fashion (20%)</div>
                <div class="flex items-center gap-2"><div style="width: 8px; height: 8px; background: #475569; border-radius: 2px;"></div>Perdagangan (15%)</div>
                <div class="flex items-center gap-2"><div style="width: 8px; height: 8px; background: #93c5fd; border-radius: 2px;"></div>Kerajinan (15%)</div>
                <div class="flex items-center gap-2"><div style="width: 8px; height: 8px; background: #dbeafe; border-radius: 2px;"></div>Jasa (10%)</div>
            </div>
        </div>
    </div>

    <!-- Table Row -->
    <div class="card p-0 overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="font-bold text-gray-900 text-lg">Pengajuan Terbaru</h3>
            <div class="flex gap-4 items-center">
                <button class="text-gray-400 hover:text-gray-700">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
                <button class="text-gray-400 hover:text-gray-700">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                </button>
            </div>
        </div>
        
        <div class="table-container p-6 pt-0">
            <table class="table" style="margin-top: -1px;">
                <thead>
                    <tr>
                        <th style="padding-top: var(--space-4);">NAMA UMKM</th>
                        <th style="padding-top: var(--space-4);">PROGRAM</th>
                        <th style="padding-top: var(--space-4);">TANGGAL</th>
                        <th style="padding-top: var(--space-4);">STATUS</th>
                        <th style="padding-top: var(--space-4); text-align: right;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div style="width: 28px; height: 28px; background: #bfdbfe; color: #1e40af; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem;">KL</div>
                                <span class="font-bold text-gray-900">Kopi Luwak Ciwidey</span>
                            </div>
                        </td>
                        <td class="text-gray-600">Sertifikasi Halal</td>
                        <td class="text-gray-600">24 Okt 2023</td>
                        <td><span class="badge badge-pending">Menunggu</span></td>
                        <td style="text-align: right;">
                            <button class="text-color-primary" style="color: var(--color-secondary);" onclick="document.getElementById('detail-modal').classList.add('open'); document.getElementById('modal-overlay').classList.add('open');">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div style="width: 28px; height: 28px; background: #e0e7ff; color: #3730a3; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem;">KS</div>
                                <span class="font-bold text-gray-900">Keripik Pedas Soreang</span>
                            </div>
                        </td>
                        <td class="text-gray-600">Bantuan Modal Usaha</td>
                        <td class="text-gray-600">23 Okt 2023</td>
                        <td><span class="badge badge-process">Dalam Proses</span></td>
                        <td style="text-align: right;">
                            <button class="text-color-primary" style="color: var(--color-secondary);">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div style="width: 28px; height: 28px; background: #dcfce7; color: #166534; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem;">AT</div>
                                <span class="font-bold text-gray-900">Batik Tenun Baleendah</span>
                            </div>
                        </td>
                        <td class="text-gray-600">Pelatihan Digital Marketing</td>
                        <td class="text-gray-600">22 Okt 2023</td>
                        <td><span class="badge badge-approved">Disetujui</span></td>
                        <td style="text-align: right;">
                            <button class="text-color-primary" style="color: var(--color-secondary);">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div style="width: 28px; height: 28px; background: #fee2e2; color: #991b1b; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem;">SM</div>
                                <span class="font-bold text-gray-900">Sepatu Majalaya Craft</span>
                            </div>
                        </td>
                        <td class="text-gray-600">Pameran UMKM Nasional</td>
                        <td class="text-gray-600">21 Okt 2023</td>
                        <td><span class="badge badge-rejected">Ditolak</span></td>
                        <td style="text-align: right;">
                            <button class="text-color-primary" style="color: var(--color-secondary);">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div style="width: 28px; height: 28px; background: #bfdbfe; color: #1e40af; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem;">SR</div>
                                <span class="font-bold text-gray-900">Susu Sapi Rancabali</span>
                            </div>
                        </td>
                        <td class="text-gray-600">Sertifikasi Halal</td>
                        <td class="text-gray-600">20 Okt 2023</td>
                        <td><span class="badge badge-pending">Menunggu</span></td>
                        <td style="text-align: right;">
                            <button class="text-color-primary" style="color: var(--color-secondary);">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="mt-4 text-right">
                <a href="#" class="text-sm font-semibold hover:underline" style="color: var(--color-secondary);">Lihat Semua &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modals')
<!-- Modal Overlay for Pengajuan Detail -->
<div id="modal-overlay" class="modal-overlay" onclick="closeModal()"></div>

<!-- Slide Panel -->
<div id="detail-modal" class="slide-panel">
    <div class="flex justify-between items-center p-6 border-b border-border">
        <div>
            <h2 class="text-lg font-bold text-gray-900">Detail Pengajuan</h2>
            <p class="text-xs text-gray-500 uppercase font-semibold">ID: REQ-2023-1012</p>
        </div>
        <button class="text-gray-500 hover:text-gray-900" onclick="closeModal()">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </div>
    
    <div class="flex-1 overflow-y-auto p-6" style="background-color: white;">
        
        <!-- Info boxes -->
        <div style="background-color: #f8fafc; padding: var(--space-4); border-radius: var(--radius-md); margin-bottom: var(--space-4);">
            <div class="text-xs text-gray-500 mb-1 font-semibold uppercase">Nama UMKM</div>
            <div class="font-bold text-primary text-base">Kopi Wangi Sejahtera</div>
        </div>

        <div style="background-color: #f8fafc; padding: var(--space-4); border-radius: var(--radius-md); margin-bottom: var(--space-6);">
            <div class="text-xs text-gray-500 mb-1 font-semibold uppercase">Program Pembinaan</div>
            <div class="font-bold text-primary text-base">Digitalisasi Pemasaran dan Optimasi Media Sosial</div>
        </div>
        
        <!-- Alasan -->
        <div class="mb-6">
            <div class="text-xs text-gray-500 mb-2 font-semibold uppercase">Alasan Pengajuan</div>
            <p class="text-sm text-gray-800 leading-relaxed italic">
                "Kami ingin memperluas jangkauan pasar hingga ke luar daerah, namun masih terkendala pemahaman mengenai penggunaan iklan digital dan manajemen konten yang profesional."
            </p>
        </div>

        <!-- Dokumen Pendukung -->
        <div class="mb-6">
            <div class="text-xs text-gray-500 mb-2 font-semibold uppercase">Dokumen Pendukung</div>
            
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-3) var(--space-4); display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--space-2);">
                <div class="flex items-center gap-3">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    <span class="text-sm font-medium text-gray-700">Profil_Usaha_KWS.pdf</span>
                </div>
                <button class="text-gray-400 hover:text-gray-700">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                </button>
            </div>

            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-3) var(--space-4); display: flex; justify-content: space-between; align-items: center;">
                <div class="flex items-center gap-3">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563eb" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                    <span class="text-sm font-medium text-gray-700">Surat_Keterangan_Domisili.jpg</span>
                </div>
                <button class="text-gray-400 hover:text-gray-700">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                </button>
            </div>
        </div>

        <div class="mb-6">
            <div class="text-xs text-gray-500 mb-2 font-semibold uppercase">Ubah Status</div>
            <div class="relative">
                <select class="input-field bg-gray-50" style="appearance: none; font-weight: 500;">
                    <option>Menunggu</option>
                    <option>Dalam Proses</option>
                    <option>Disetujui</option>
                    <option>Ditolak</option>
                </select>
                <span class="absolute inset-y-0 right-0" style="display: flex; align-items: center; padding-right: 1rem; pointer-events: none; color: var(--color-text-muted);">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
        </div>

        <div>
            <div class="text-xs text-gray-500 mb-2 font-semibold uppercase">Catatan Verifikasi</div>
            <textarea class="input-field bg-gray-50" rows="4" placeholder="Masukkan catatan atau alasan verifikasi di sini..." style="resize: vertical;"></textarea>
        </div>

    </div>
    
    <div class="p-6 border-t border-border flex flex-col gap-3">
        <button class="btn btn-primary w-full shadow-sm" style="background-color: var(--color-primary); justify-content: center; padding: 0.75rem;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 0.5rem;"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
            Simpan Perubahan
        </button>
        <button class="btn btn-outline w-full shadow-sm" style="justify-content: center; padding: 0.75rem; background: white;" onclick="closeModal()">
            Tutup
        </button>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('detail-modal').classList.remove('open');
        document.getElementById('modal-overlay').classList.remove('open');
    }
</script>
@endsection
