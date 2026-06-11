@extends('layouts.app')

@section('title', 'Materi Edukasi')

@section('sidebar')
<x-dinas-sidebar active="materi-edukasi" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Materi Edukasi</div>
        <div class="page-subtitle">Pantau materi pembinaan yang tersedia untuk UMKM.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Pusat Edukasi</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Daftar Materi Edukasi</h1>
            <p class="page-subtitle">Materi yang tampil di halaman UMKM dikumpulkan di sini.</p>
        </div>
        <div class="flex items-center gap-3" style="flex-wrap: wrap;">
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Total Materi</span>
                <div class="detail-value" style="font-weight: 800;">{{ $materi->total() }}</div>
            </div>
            <a href="{{ route('dinas.materi-edukasi.create') }}" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Tambah Materi
            </a>
        </div>
    </div>

    <section class="content-card">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Judul Materi</th>
                        <th>Deskripsi</th>
                        <th>Dibuat</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($materi as $item)
                        <tr>
                            <td>
                                <div style="font-weight: 800; color: var(--color-gray-900);">{{ $item->title }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ basename($item->file_path) }}</div>
                            </td>
                            <td>{{ $item->description ? \Illuminate\Support\Str::limit($item->description, 120) : '-' }}</td>
                            <td style="white-space: nowrap;">{{ $item->created_at->format('d M Y') }}</td>
                            <td style="text-align: right;">
                                <a href="{{ route('dinas.materi-edukasi.download', $item->id) }}" class="link-action">Unduh</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada materi edukasi</h3>
                                    <p style="margin-bottom: var(--space-4);">Materi edukasi akan tampil setelah data tersedia.</p>
                                    <a href="{{ route('dinas.materi-edukasi.create') }}" class="btn btn-primary">Tambah Materi Pertama</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($materi->hasPages())
            <div style="margin-top: var(--space-4);">
                {{ $materi->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
