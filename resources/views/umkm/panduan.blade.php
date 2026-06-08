@extends('layouts.app')

@section('title', 'Panduan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="panduan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <span style="color: var(--color-primary); font-weight: 700;">Panduan</span>
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
<div class="max-w-4xl mx-auto py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Panduan Penggunaan Sistem & Informasi Kontak</h1>
        <p class="text-gray-600 mt-2">Panduan lengkap menggunakan Portal UMKM dan informasi kontak Dinas Koperasi dan UKM.</p>
    </div>

    <!-- Informasi Kontak -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Hubungi Kami</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Email</h3>
                        <p class="mt-1 text-gray-600">diskopukm@bandungkab.go.id</p>
                        <p class="text-sm text-gray-500">Senin - Jumat (08:00 - 16:00)</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="flex-shrink-0 h-10 w-10 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Telepon / WhatsApp</h3>
                        <p class="mt-1 text-gray-600">+62 811-2222-3333</p>
                        <p class="text-sm text-gray-500">Layanan pengaduan dan bantuan UMKM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Panduan Penggunaan -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-900">Panduan Penggunaan Portal UMKM</h2>
        </div>
        
        <div class="p-6">
            <div class="space-y-8">
                
                <!-- Panduan 1 -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">1. Melengkapi Profil Usaha</h3>
                    <p class="text-gray-600 mb-3">Pastikan profil usaha Anda telah lengkap sebelum mengajukan pendanaan atau mendaftar event.</p>
                    <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2">
                        <li>Buka menu <span class="font-semibold text-gray-800">Profil Saya</span> di sidebar.</li>
                        <li>Klik tombol <span class="font-semibold text-gray-800">Edit Profil</span>.</li>
                        <li>Isi data dengan lengkap (Nama Usaha, Alamat, Kategori, Skala Usaha).</li>
                        <li>Simpan perubahan.</li>
                    </ul>
                </div>

                <!-- Panduan 2 -->
                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">2. Pengajuan Pendanaan</h3>
                    <p class="text-gray-600 mb-3">UMKM dapat mengajukan program pendanaan yang tersedia dari Dinas Koperasi dan UKM.</p>
                    <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2">
                        <li>Buka menu <span class="font-semibold text-gray-800">Pengajuan Dana</span>.</li>
                        <li>Pilih program yang tersedia dan klik <span class="font-semibold text-gray-800">Ajukan</span>.</li>
                        <li>Isi formulir pengajuan pendanaan secara lengkap.</li>
                        <li>Pantau status pengajuan Anda (Pending, Disetujui, Ditolak).</li>
                    </ul>
                </div>

                <!-- Panduan 3 -->
                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">3. Mendaftar Event & Pelatihan</h3>
                    <p class="text-gray-600 mb-3">Ikuti berbagai kegiatan pelatihan dan pameran untuk mengembangkan bisnis Anda.</p>
                    <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2">
                        <li>Buka menu <span class="font-semibold text-gray-800">Event & Pelatihan</span>.</li>
                        <li>Cari event yang sedang buka pendaftaran.</li>
                        <li>Klik <span class="font-semibold text-gray-800">Daftar Event</span>.</li>
                        <li>Setelah event selesai, Anda dapat memberikan <span class="font-semibold text-gray-800">Feedback</span> melalui menu Riwayat Event.</li>
                    </ul>
                </div>

                <!-- Panduan 4 -->
                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">4. Laporan Perkembangan Usaha</h3>
                    <p class="text-gray-600 mb-3">UMKM yang telah menerima bantuan pendanaan wajib mengirimkan laporan berkala (Q1-Q4).</p>
                    <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2">
                        <li>Buka menu <span class="font-semibold text-gray-800">Laporan Usaha</span>.</li>
                        <li>Isi formulir laporan omzet per kuartal.</li>
                        <li>Anda dapat menyimpan sebagai <span class="font-semibold text-gray-800">Draft</span> jika belum selesai.</li>
                        <li>Jika sudah yakin, klik <span class="font-semibold text-gray-800">Submit Laporan</span>.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
