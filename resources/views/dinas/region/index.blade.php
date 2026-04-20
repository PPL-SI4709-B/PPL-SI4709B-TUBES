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
            <div class="user-name">Petugas Dinas</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            <img src="https://ui-avatars.com/api/?name=Petugas+Dinas&background=2563eb&color=fff" alt="Avatar">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">

    {{-- Flash Messages --}}
    @if(session('success'))
        <div style="background-color: var(--color-status-approve-bg); color: var(--color-status-approve-text); padding: var(--space-3) var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 600; display: flex; align-items: center; gap: var(--space-2);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Header Row --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="font-bold" style="font-size: var(--text-xl); color: var(--color-text-dark);">Kelola Wilayah</h1>
            <p class="text-sm text-muted mt-1">Data wilayah untuk profil UMKM</p>
        </div>
        <a href="{{ route('dinas.region.create') }}" class="btn btn-brand" id="btn-tambah-wilayah">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Wilayah
        </a>
    </div>

    {{-- Table --}}
    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: var(--color-input-bg); border-bottom: 1px solid var(--color-border);">
                        <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em; width: 50px;">No</th>
                        <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Nama Wilayah</th>
                        <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Deskripsi</th>
                        <th style="padding: var(--space-3) var(--space-4); text-align: left; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Dibuat</th>
                        <th style="padding: var(--space-3) var(--space-4); text-align: right; font-size: 11px; font-weight: 700; color: var(--color-text-muted); text-transform: uppercase; letter-spacing: 0.05em;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($regions as $region)
                        <tr style="border-bottom: 1px solid var(--color-border);" onmouseover="this.style.backgroundColor='var(--color-input-bg)'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); color: var(--color-text-muted);">
                                {{ ($regions->currentPage() - 1) * $regions->perPage() + $loop->iteration }}
                            </td>
                            <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); font-weight: 600; color: var(--color-text-dark);">
                                {{ $region->name }}
                            </td>
                            <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); color: var(--color-text-main); max-width: 300px;">
                                {{ $region->description ?? '-' }}
                            </td>
                            <td style="padding: var(--space-3) var(--space-4); font-size: var(--text-sm); color: var(--color-text-muted);">
                                {{ $region->created_at->format('d M Y') }}
                            </td>
                            <td style="padding: var(--space-3) var(--space-4); text-align: right;">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('dinas.region.edit', $region) }}" title="Edit" style="color: var(--color-primary); padding: 4px;" id="btn-edit-{{ $region->id }}">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </a>
                                    <form action="{{ route('dinas.region.destroy', $region) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus wilayah ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" style="color: var(--color-status-reject-text); padding: 4px; cursor: pointer; background: none; border: none;" id="btn-delete-{{ $region->id }}">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: var(--space-8); text-align: center; color: var(--color-text-muted); font-size: var(--text-sm);">
                                <div class="flex flex-col items-center gap-3">
                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-text-light);"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                                    <span>Belum ada data wilayah.</span>
                                    <a href="{{ route('dinas.region.create') }}" class="btn btn-brand" style="font-size: var(--text-sm);">Tambah Wilayah Pertama</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($regions->hasPages())
            <div style="padding: var(--space-3) var(--space-4); border-top: 1px solid var(--color-border); display: flex; justify-content: space-between; align-items: center;">
                <span style="font-size: var(--text-sm); color: var(--color-text-muted);">
                    Menampilkan {{ $regions->firstItem() }}–{{ $regions->lastItem() }} dari {{ $regions->total() }} data
                </span>
                <div class="flex gap-1">
                    @if($regions->onFirstPage())
                        <span style="padding: 6px 12px; font-size: var(--text-sm); color: var(--color-text-light); border: 1px solid var(--color-border); border-radius: var(--radius-sm);">&laquo;</span>
                    @else
                        <a href="{{ $regions->previousPageUrl() }}" style="padding: 6px 12px; font-size: var(--text-sm); color: var(--color-primary); border: 1px solid var(--color-border); border-radius: var(--radius-sm);">&laquo;</a>
                    @endif

                    @foreach($regions->getUrlRange(1, $regions->lastPage()) as $page => $url)
                        @if($page == $regions->currentPage())
                            <span style="padding: 6px 12px; font-size: var(--text-sm); color: white; background-color: var(--color-primary); border-radius: var(--radius-sm); font-weight: 600;">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" style="padding: 6px 12px; font-size: var(--text-sm); color: var(--color-text-main); border: 1px solid var(--color-border); border-radius: var(--radius-sm);">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($regions->hasMorePages())
                        <a href="{{ $regions->nextPageUrl() }}" style="padding: 6px 12px; font-size: var(--text-sm); color: var(--color-primary); border: 1px solid var(--color-border); border-radius: var(--radius-sm);">&raquo;</a>
                    @else
                        <span style="padding: 6px 12px; font-size: var(--text-sm); color: var(--color-text-light); border: 1px solid var(--color-border); border-radius: var(--radius-sm);">&raquo;</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
