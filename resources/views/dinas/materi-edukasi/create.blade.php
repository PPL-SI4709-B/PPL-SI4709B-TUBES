@extends('layouts.app')

@section('title', 'Tambah Materi Edukasi')

@section('sidebar')
<x-dinas-sidebar active="materi-edukasi" />
@endsection

@section('header')
<header class="main-header">
    <div class="flex items-center gap-3">
        <a href="{{ route('dinas.materi-edukasi.index') }}" style="color: var(--color-text-muted);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <div>
            <div class="page-title">Tambah Materi Edukasi</div>
            <div class="page-subtitle">Unggah materi pembinaan yang akan ditampilkan kepada UMKM.</div>
        </div>
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
<div style="max-width: 680px;">
    <div class="card" style="padding: var(--space-6);">
        <form action="{{ route('dinas.materi-edukasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col gap-5">
                <div>
                    <label for="title" style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Judul Materi <span style="color: var(--color-danger);">*</span></label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('title') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);"
                        placeholder="Contoh: Panduan Pengemasan Produk" required>
                    @error('title')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="description" style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Deskripsi</label>
                    <textarea id="description" name="description" rows="4"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('description') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;"
                        placeholder="Ringkasan isi materi untuk membantu UMKM memahami konteksnya.">{{ old('description') }}</textarea>
                    @error('description')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="file" style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">File Materi <span style="color: var(--color-danger);">*</span></label>
                    <input id="file" type="file" name="file"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('file') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm); background-color: white;"
                        accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.jpg,.jpeg,.png,.zip" required>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 6px;">Format: PDF, Office, gambar, atau ZIP. Maksimal 20 MB.</div>
                    @error('file')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex gap-3 justify-end" style="margin-top: var(--space-2);">
                    <a href="{{ route('dinas.materi-edukasi.index') }}" class="btn" style="background-color: #f1f5f9; color: var(--color-text);">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Materi</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
