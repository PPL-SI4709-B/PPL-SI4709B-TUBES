@extends('layouts.app')

@section('title', 'Edit Program')

@section('sidebar')
<x-dinas-sidebar active="program" />
@endsection

@section('header')
<header class="main-header">
    <div class="flex items-center gap-3">
        <a href="{{ route('dinas.program.index') }}" style="color: var(--color-text-muted);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <div class="page-title">Edit Program</div>
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
        <form action="{{ route('dinas.program.update', $program) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-5">

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Jenis Program <span style="color: var(--color-danger);">*</span></label>
                    <select name="jenis"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('jenis') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm); background-color: white;">
                        <option value="pembinaan" {{ old('jenis', $program->jenis) === 'pembinaan' ? 'selected' : '' }}>Pembinaan</option>
                        <option value="pendanaan" {{ old('jenis', $program->jenis) === 'pendanaan' ? 'selected' : '' }}>Pendanaan</option>
                    </select>
                    @error('jenis')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Nama Program <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $program->name) }}"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('name') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);">
                    @error('name')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Deskripsi</label>
                    <textarea name="description" rows="3"
                        style="width: 100%; padding: var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;">{{ old('description', $program->description) }}</textarea>
                    @error('description')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Kuota Peserta <span style="color: var(--color-danger);">*</span></label>
                    <input type="number" name="quota" value="{{ old('quota', $program->quota) }}" min="0"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('quota') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);">
                    @error('quota')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $program->start_date?->format('Y-m-d')) }}"
                            style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('start_date') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);">
                        @error('start_date')
                            <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $program->end_date?->format('Y-m-d')) }}"
                            style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('end_date') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm);">
                        @error('end_date')
                            <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div>
                    <label style="display: block; font-size: var(--text-sm); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-2);">Status <span style="color: var(--color-danger);">*</span></label>
                    <select name="status"
                        style="width: 100%; padding: var(--space-3); border: 1px solid {{ $errors->has('status') ? 'var(--color-danger)' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: var(--text-sm); background-color: white;">
                        <option value="active" {{ old('status', $program->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $program->status) === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div style="font-size: var(--text-xs); color: var(--color-danger); margin-top: 4px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="flex gap-3 justify-end" style="margin-top: var(--space-2);">
                    <a href="{{ route('dinas.program.index') }}" class="btn" style="background-color: #f1f5f9; color: var(--color-text);">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
