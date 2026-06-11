@extends('layouts.app')

@section('title', 'Materi Edukasi - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="materi-edukasi" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Materi Edukasi</div>
        <div class="page-subtitle">Baca dan unduh materi pembinaan untuk mendukung pengembangan usaha.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="support-page">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Pusat Edukasi</div>
            <h1>Materi Edukasi</h1>
            <p class="page-subtitle">Kumpulan materi dari Dinas untuk membantu UMKM belajar secara mandiri.</p>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="support-grid">
        @forelse ($materi as $item)
            <article class="content-card education-card" style="padding: 0;">
                <div class="education-card-media">
                    @if($item->thumbnail_path)
                        <img src="{{ Storage::url($item->thumbnail_path) }}" alt="{{ $item->title }}">
                    @else
                        <svg width="42" height="42" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                        </svg>
                    @endif
                </div>

                <div style="padding: var(--space-5); display: flex; flex-direction: column; gap: var(--space-3); flex: 1;">
                    <h2 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); line-height: 1.35; margin: 0;">{{ $item->title }}</h2>
                    <p class="stat-note" style="line-height: 1.6; flex: 1;">{{ \Illuminate\Support\Str::limit($item->description, 120) }}</p>

                    <div class="action-group" style="justify-content: space-between; padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                        <a href="{{ route('umkm.materi-edukasi.show', $item->id) }}" class="link-action">Baca Detail</a>
                        <a href="{{ route('umkm.materi-edukasi.download', $item->id) }}" class="btn btn-primary" style="padding: 8px 14px;">Unduh</a>
                    </div>
                </div>
            </article>
        @empty
            <div class="support-empty-state" style="grid-column: 1 / -1;">
                <span class="support-icon">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                </span>
                <h3>Belum ada materi edukasi</h3>
                <p>Materi edukasi akan ditambahkan oleh Petugas Dinas.</p>
            </div>
        @endforelse
    </div>

    @if ($materi->hasPages())
        <div>
            {{ $materi->links() }}
        </div>
    @endif
</div>
@endsection
