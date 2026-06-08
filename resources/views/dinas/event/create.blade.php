@extends('layouts.app')

@section('title', 'Tambah Event')

@section('sidebar')
<x-dinas-sidebar active="event" />
@endsection

@section('header')
<header class="main-header">
    <div class="flex items-center gap-3">
        <a href="{{ route('dinas.event.index') }}" style="color: var(--color-text-muted);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <div class="page-title">Tambah Event</div>
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
        <form action="{{ route('dinas.event.store') }}" method="POST">
            @csrf

            <div class="flex flex-col gap-5">

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Judul Event <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('title') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);"
                        placeholder="Contoh: Pelatihan Kewirausahaan">
                    @error('title')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Deskripsi</label>
                    <textarea name="description" rows="3"
                        style="width: 100%; padding: var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;"
                        placeholder="Deskripsi singkat event...">{{ old('description') }}</textarea>
                    @error('description')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Tanggal & Waktu <span style="color: var(--color-danger);">*</span></label>
                        <input type="datetime-local" name="event_date" value="{{ old('event_date') }}"
                            style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('event_date') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);">
                        @error('event_date')
                            <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Kuota Peserta <span style="color: var(--color-danger);">*</span></label>
                        <input type="number" name="quota" value="{{ old('quota', 0) }}" min="1"
                            style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('quota') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);">
                        @error('quota')
                            <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Lokasi <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="location" value="{{ old('location') }}"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('location') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);"
                        placeholder="Contoh: Gedung Sabilulungan">
                    @error('location')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Jenis</label>
                        <select name="type"
                            style="width: 100%; padding: var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); background-color: white;">
                            <option value="pelatihan" {{ old('type', 'pelatihan') === 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                            <option value="bootcamp" {{ old('type') === 'bootcamp' ? 'selected' : '' }}>Bootcamp</option>
                            <option value="seminar" {{ old('type') === 'seminar' ? 'selected' : '' }}>Seminar</option>
                            <option value="workshop" {{ old('type') === 'workshop' ? 'selected' : '' }}>Workshop</option>
                        </select>
                        @error('type')
                            <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Status <span style="color: var(--color-danger);">*</span></label>
                        <select name="status"
                            style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('status') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm); background-color: white;">
                            <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="flex gap-3 justify-end" style="margin-top: var(--space-2);">
                    <a href="{{ route('dinas.event.index') }}" class="btn" style="background-color: #f1f5f9; color: var(--color-text);">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Event</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
