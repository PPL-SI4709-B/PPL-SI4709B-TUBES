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
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-center mb-6">
            <div>
                <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900);">Master Sumber Pendanaan</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">Pengelolaan skema rekomendasi pendanaan UMKM melalui BPR Kerta Raharja.</div>
            </div>
            <a href="{{ route('dinas.sumber-pendanaan.create') }}" class="btn btn-primary">
                + Tambah Sumber Pendanaan
            </a>
        </div>

        @forelse ($sumberPendanaans as $item)
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-5); margin-bottom: var(--space-3);">
                <div class="flex justify-between items-start">
                    <div style="flex: 1;">
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 600; text-transform: uppercase;">Nama Program</div>
                        <div style="font-weight: 600; font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $item->nama_program }}</div>
                        @if ($item->deskripsi)
                            <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 4px;">{{ Str::limit($item->deskripsi, 100) }}</div>
                        @endif
                        <div class="flex gap-4 mt-3" style="font-size: var(--text-xs); color: var(--color-text-muted);">
                            <span>Mitra Penyalur: <strong>{{ $item->mitra_penyalur }}</strong></span>
                            <span>Batas Maksimal: <strong>Rp {{ number_format($item->batas_maksimal, 0, ',', '.') }}</strong></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 ml-4">
                        <span style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 600;">Status</span>
                        <span class="badge" style="background-color: {{ $item->status === 'aktif' ? 'var(--color-success-bg)' : '#f1f5f9' }}; color: {{ $item->status === 'aktif' ? 'var(--color-success)' : 'var(--color-text-muted)' }};">
                            {{ $item->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <span style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 600;">Aksi</span>
                        <a href="{{ route('dinas.sumber-pendanaan.edit', $item) }}" style="font-size: var(--text-sm); color: var(--color-secondary); font-weight: 500;">Edit</a>
                        <form action="{{ route('dinas.sumber-pendanaan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus sumber pendanaan ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="font-size: var(--text-sm); color: var(--color-danger); font-weight: 500; background: none; border: none; cursor: pointer;">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: var(--space-12) 0; color: var(--color-text-muted);">
                <div style="font-size: var(--text-sm); margin-bottom: var(--space-3);">Belum ada sumber pendanaan.</div>
                <a href="{{ route('dinas.sumber-pendanaan.create') }}" class="btn btn-primary">Tambah Sumber Pendanaan Pertama</a>
            </div>
        @endforelse

        @if ($sumberPendanaans->hasPages())
            <div class="mt-4">
                {{ $sumberPendanaans->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
