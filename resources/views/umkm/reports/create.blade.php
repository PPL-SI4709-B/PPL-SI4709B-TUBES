@extends('layouts.app')

@section('title', 'Buat Laporan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="reports" />
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
