@extends('layouts.app')

@section('title', 'Buat Laporan Perkembangan Usaha')

@section('sidebar')
    <aside class="sidebar sidebar-light">
        <div class="sidebar-brand">
            <h1 class="brand-title">Portal UMKM</h1>
            <p class="brand-subtitle">Kabupaten Bandung</p>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('umkm.dashboard') }}" class="nav-item">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                </div>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('umkm.pengajuan.index') }}" class="nav-item">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <span>Pengajuan Pendanaan</span>
            </a>
            <a href="{{ route('umkm.laporan_berkala.index') }}" class="nav-item active">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                </div>
                <span>Laporan Berkala</span>
            </a>
        </nav>
        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn w-full justify-start" style="background: none; border: none; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>
@endsection

@section('header')
    <header class="main-header">
        <h2 class="page-title">Buat Laporan Berkala</h2>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->role }}</div>
            </div>
            <div class="user-avatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="max-w-3xl mx-auto pb-10">
        <div class="bg-white shadow sm:rounded-lg overflow-hidden border border-gray-200">
            <div class="px-4 py-5 sm:px-6 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Form Laporan Perkembangan Usaha</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Silakan isi data laporan perkembangan usaha untuk kuartal ini.</p>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('umkm.laporan_berkala.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun Laporan</label>
                            <input type="text" name="tahun" id="tahun" value="{{ date('Y') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border" required>
                            @error('tahun')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="kuartal" class="block text-sm font-medium text-gray-700">Kuartal</label>
                            <select id="kuartal" name="kuartal" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                <option value="Q1">Q1 (Januari - Maret)</option>
                                <option value="Q2">Q2 (April - Juni)</option>
                                <option value="Q3">Q3 (Juli - September)</option>
                                <option value="Q4">Q4 (Oktober - Desember)</option>
                            </select>
                            @error('kuartal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="omzet" class="block text-sm font-medium text-gray-700">Omzet Usaha (Kuartal Ini)</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="omzet" id="omzet" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md py-2 px-3 border" placeholder="0" min="0" required>
                            </div>
                            @error('omzet')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="jumlah_karyawan" class="block text-sm font-medium text-gray-700">Jumlah Karyawan Saat Ini</label>
                            <input type="number" name="jumlah_karyawan" id="jumlah_karyawan" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md py-2 px-3 border" min="0" required>
                            @error('jumlah_karyawan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="kendala" class="block text-sm font-medium text-gray-700">Kendala yang Dihadapi (Opsional)</label>
                            <div class="mt-1">
                                <textarea id="kendala" name="kendala" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md border py-2 px-3"></textarea>
                            </div>
                            @error('kendala')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-6">
                            <label for="strategi_kedepan" class="block text-sm font-medium text-gray-700">Strategi ke Depan (Opsional)</label>
                            <div class="mt-1">
                                <textarea id="strategi_kedepan" name="strategi_kedepan" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md border py-2 px-3"></textarea>
                            </div>
                            @error('strategi_kedepan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <a href="{{ route('umkm.laporan_berkala.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 mr-3">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
