@extends('layouts.app')

@section('title', 'Wilayah - Portal UMKM')

@section('sidebar')
@include('dinas.region._sidebar')
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Wilayah</div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff" alt="{{ Auth::user()->name }}">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" dusk="region-index">
    @if(session('success'))
        <div dusk="flash-success" class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Master Data</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Kelola Wilayah</h1>
            <p class="page-subtitle">Data wilayah yang digunakan pada profil UMKM.</p>
        </div>
        <a href="{{ route('dinas.region.create') }}" class="btn btn-primary" id="btn-tambah-wilayah" dusk="region-create-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Wilayah
        </a>
    </div>

    <section class="content-card">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 4rem;">No</th>
                        <th>Nama Wilayah</th>
                        <th>Deskripsi</th>
                        <th>Dibuat</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($regions as $region)
                        <tr dusk="region-row-{{ $region->id }}">
                            <td>{{ ($regions->currentPage() - 1) * $regions->perPage() + $loop->iteration }}</td>
                            <td style="font-weight: 800; color: var(--color-gray-900);">{{ $region->name }}</td>
                            <td style="max-width: 24rem;">{{ $region->description ?? 'Belum tersedia' }}</td>
                            <td style="white-space: nowrap;">{{ $region->created_at->format('d M Y') }}</td>
                            <td style="text-align: right;">
                                <div class="action-group">
                                    <a href="{{ route('dinas.region.edit', $region) }}" title="Edit" class="link-action" id="btn-edit-{{ $region->id }}" dusk="region-edit-{{ $region->id }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <form action="{{ route('dinas.region.destroy', $region) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus wilayah ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" style="color: var(--color-danger); padding: 4px; cursor: pointer; background: none; border: none;" id="btn-delete-{{ $region->id }}" dusk="region-delete-{{ $region->id }}">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada data wilayah</h3>
                                    <p style="margin-bottom: var(--space-4);">Tambahkan wilayah agar profil UMKM dapat dipetakan.</p>
                                    <a href="{{ route('dinas.region.create') }}" class="btn btn-primary">Tambah Wilayah Pertama</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($regions->hasPages())
            <div style="margin-top: var(--space-4);">
                {{ $regions->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
