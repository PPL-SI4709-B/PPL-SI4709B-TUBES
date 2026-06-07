@extends('layouts.app')

@section('title', 'Tambah Sumber Pendanaan')

@section('sidebar')
<x-dinas-sidebar active="sumber-pendanaan" />
@endsection

@section('header')
<header class="main-header">
    <div class="flex items-center gap-3">
        <a href="{{ route('dinas.sumber-pendanaan.index') }}" style="color: var(--color-text-muted);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <div class="page-title">Tambah Sumber Pendanaan</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()?->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
        </div>
    </div>
</header>
@endsection

@section('content')
<div style="max-width: 640px;">
    <div class="card" style="padding: var(--space-6);">
        <form action="{{ route('dinas.sumber-pendanaan.store') }}" method="POST">
            @csrf

            <div class="flex flex-col gap-5">

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Nama Program <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="nama_program" value="{{ old('nama_program') }}"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('nama_program') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);"
                        placeholder="Contoh: Rekomendasi Pendanaan UMKM">
                    @error('nama_program')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Mitra Penyalur <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="mitra_penyalur" value="{{ old('mitra_penyalur', 'BPR Kerta Raharja') }}"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('mitra_penyalur') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);"
                        placeholder="Contoh: BPR Kerta Raharja">
                    @error('mitra_penyalur')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Batas Maksimal (Rp) <span style="color: var(--color-danger);">*</span></label>
                    <input type="number" name="batas_maksimal" value="{{ old('batas_maksimal', 6000000) }}" min="1" max="6000000" step="1000"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('batas_maksimal') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);">
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 4px;">Maksimal Rp 6.000.000 sesuai ketentuan mitra.</div>
                    @error('batas_maksimal')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        style="width: 100%; padding: var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;"
                        placeholder="Penjelasan singkat tentang skema pendanaan...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Persyaratan</label>
                    <textarea name="persyaratan" rows="3"
                        style="width: 100%; padding: var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;"
                        placeholder="Syarat umum untuk pengajuan pendanaan...">{{ old('persyaratan') }}</textarea>
                    @error('persyaratan')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Status <span style="color: var(--color-danger);">*</span></label>
                    <select name="status"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('status') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm); background-color: white;">
                        <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex gap-3 justify-end" style="margin-top: var(--space-2);">
                    <a href="{{ route('dinas.sumber-pendanaan.index') }}" class="btn" style="background-color: #f1f5f9; color: var(--color-text);">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
