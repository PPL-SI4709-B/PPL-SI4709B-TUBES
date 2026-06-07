@extends('layouts.app')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>
    
    <nav class="nav-menu">
        <a href="{{ route('dinas.dashboard') }}" class="nav-item">
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
        <a href="{{ route('dinas.report.index') }}" class="nav-item active">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
            </span>
            Laporan UMKM
        </a>
    </nav>
    
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Evaluasi Laporan</div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">Siti Rahayu</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            <img src="https://ui-avatars.com/api/?name=Siti+Rahayu&background=2563eb&color=fff" alt="Avatar">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="card p-6">
    <div class="mb-6">
        <h3 class="font-bold text-gray-900 text-lg mb-2">Laporan: {{ $report['umkm_name'] }}</h3>
        <p class="text-gray-600">Periode: {{ $report['period'] }}</p>
    </div>

    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
        <h4 class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Isi Laporan</h4>
        <p class="text-gray-800">{{ $report['report_content'] }}</p>
    </div>

    <form action="{{ route('dinas.evaluation.store', $report['id']) }}" method="POST">
        @csrf
        
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Skor Evaluasi (1-5)</label>
            <div class="flex gap-4">
                @for ($i = 1; $i <= 5; $i++)
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="score" value="{{ $i }}" {{ old('score') == $i ? 'checked' : '' }} required>
                        <span class="text-sm font-medium">{{ $i }}</span>
                    </label>
                @endfor
            </div>
            @error('score')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Catatan Evaluasi</label>
            <textarea name="notes" id="notes" class="input-field w-full" rows="4" placeholder="Masukkan analisis dan saran untuk UMKM..." required>{{ old('notes') }}</textarea>
            @error('notes')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-8">
            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status Akhir Laporan</label>
            <select name="status" id="status" class="input-field w-full" required>
                <option value="">Pilih Status</option>
                <option value="passed" {{ old('status') == 'passed' ? 'selected' : '' }}>Lulus Evaluasi</option>
                <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Tidak Lulus</option>
                <option value="revision" {{ old('status') == 'revision' ? 'selected' : '' }}>Perlu Revisi</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 justify-end">
            <a href="{{ route('dinas.report.index') }}" class="btn btn-outline">Batal</a>
            <button type="submit" class="btn btn-primary" style="background-color: var(--color-primary);">Simpan Evaluasi</button>
        </div>
    </form>
</div>
@endsection
