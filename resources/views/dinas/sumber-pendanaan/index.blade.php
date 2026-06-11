@extends('layouts.app')

@section('title', 'Master Sumber Pendanaan')

@section('sidebar')
<x-dinas-sidebar active="sumber-pendanaan" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Master Sumber Pendanaan</div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()?->name }}</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Master Pendanaan</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Sumber Pendanaan</h1>
            <p class="page-subtitle">Kelola skema rekomendasi pendanaan UMKM melalui mitra penyalur.</p>
        </div>
        <a href="{{ route('dinas.sumber-pendanaan.create') }}" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Sumber Pendanaan
        </a>
    </div>

    <section class="content-card">
        <div class="flex flex-col gap-3">
            @forelse ($sumberPendanaans as $item)
                <div class="list-card">
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; align-items: center; gap: var(--space-3); flex-wrap: wrap;">
                            <h2 style="font-weight: 800; font-size: var(--text-base); color: var(--color-gray-900); margin: 0;">{{ $item->nama_program }}</h2>
                            <span class="badge {{ $item->status === 'aktif' ? 'badge-success' : 'badge-secondary' }}">
                                {{ $item->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        @if ($item->deskripsi)
                            <p style="font-size: var(--text-sm); color: var(--color-text-muted); margin: var(--space-2) 0 0; line-height: 1.6;">{{ \Illuminate\Support\Str::limit($item->deskripsi, 120) }}</p>
                        @endif
                        <div style="display: flex; gap: var(--space-4); flex-wrap: wrap; margin-top: var(--space-3); font-size: var(--text-xs); color: var(--color-text-muted);">
                            <span>Mitra Penyalur: <strong style="color: var(--color-gray-900);">{{ $item->mitra_penyalur }}</strong></span>
                            <span>Batas Maksimal: <strong style="color: var(--color-gray-900);">Rp {{ number_format($item->batas_maksimal, 0, ',', '.') }}</strong></span>
                        </div>
                    </div>
                    <div class="action-group">
                        <a href="{{ route('dinas.sumber-pendanaan.edit', $item) }}" class="link-action">Edit</a>
                        <form action="{{ route('dinas.sumber-pendanaan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus sumber pendanaan ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="font-size: var(--text-sm); color: var(--color-danger); font-weight: 700; background: none; border: none; cursor: pointer;">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada sumber pendanaan</h3>
                    <p style="margin-bottom: var(--space-4);">Tambahkan skema pendanaan agar UMKM dapat mengajukan rekomendasi.</p>
                    <a href="{{ route('dinas.sumber-pendanaan.create') }}" class="btn btn-primary">Tambah Sumber Pendanaan Pertama</a>
                </div>
            @endforelse
        </div>

        @if ($sumberPendanaans->hasPages())
            <div style="margin-top: var(--space-4);">
                {{ $sumberPendanaans->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
