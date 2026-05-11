@extends('layouts.app')

@section('title', 'Edit Skala Usaha - Portal UMKM')

@section('sidebar')
<x-dinas-sidebar active="master-data" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Edit Skala Usaha</div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff" alt="{{ Auth::user()->name }}">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 640px;">

    <div class="flex items-center gap-2" style="font-size: var(--text-sm); color: var(--color-text-muted);">
        <a href="{{ route('dinas.scale.index') }}" style="color: var(--color-primary); font-weight: 600;">Skala Usaha</a>
        <span>/</span>
        <span>Edit</span>
    </div>

    <div class="card" style="padding: var(--space-6);">
        <h2 class="font-bold mb-6" style="font-size: var(--text-lg); color: var(--color-text-dark);">Edit Skala Usaha</h2>

        <form action="{{ route('dinas.scale.update', $scale) }}" method="POST" id="form-edit-scale">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="input-label mb-2">NAMA SKALA USAHA <span style="color: var(--color-status-reject-text);">*</span></label>
                <input type="text" name="name" id="name" class="input-field" value="{{ old('name', $scale->name) }}" placeholder="Contoh: Mikro, Kecil, Menengah" required>
                @error('name')
                    <p style="color: var(--color-status-reject-text); font-size: var(--text-xs); margin-top: var(--space-1); font-weight: 500;">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="input-label mb-2">DESKRIPSI</label>
                <textarea name="description" id="description" class="input-field" rows="4" placeholder="Deskripsi singkat skala usaha (opsional)" style="resize: vertical;">{{ old('description', $scale->description) }}</textarea>
                @error('description')
                    <p style="color: var(--color-status-reject-text); font-size: var(--text-xs); margin-top: var(--space-1); font-weight: 500;">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="btn btn-brand" id="btn-update">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                    Perbarui
                </button>
                <a href="{{ route('dinas.scale.index') }}" class="btn" style="background-color: white; border: 1px solid var(--color-border); color: var(--color-text-main);" id="btn-batal">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
