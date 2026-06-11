@extends('layouts.app')

@section('title', 'Detail Materi Edukasi - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="materi-edukasi" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Detail Materi Edukasi</div>
        <div class="page-subtitle">Baca ringkasan materi dan unduh dokumen pembinaan.</div>
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
<div class="support-page narrow">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Materi Edukasi</div>
            <h1>{{ $materiEdukasi->title }}</h1>
            <p class="page-subtitle">Dipublikasikan pada {{ $materiEdukasi->created_at->format('d M Y') }}</p>
        </div>
        <a href="{{ route('umkm.materi-edukasi.index') }}" class="btn btn-secondary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <article class="content-card" style="padding: 0; overflow: hidden;">
        @if($materiEdukasi->thumbnail_path)
            <div class="education-card-media" style="aspect-ratio: 16 / 7;">
                <img src="{{ Storage::url($materiEdukasi->thumbnail_path) }}" alt="{{ $materiEdukasi->title }}">
            </div>
        @endif

        <div style="padding: var(--space-6);">
            <div class="stat-card-row" style="margin-bottom: var(--space-5);">
                <div>
                    <h2 class="section-title">{{ $materiEdukasi->title }}</h2>
                    <p class="section-subtitle">Materi edukasi untuk pengembangan UMKM.</p>
                </div>
                <a href="{{ route('umkm.materi-edukasi.download', $materiEdukasi->id) }}" class="btn btn-primary">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-1m-4-4-4 4m0 0-4-4m4 4V4"></path></svg>
                    Unduh Materi
                </a>
            </div>

            <div class="detail-value" style="font-size: var(--text-base); white-space: pre-line;">
                {{ $materiEdukasi->description }}
            </div>
        </div>
    </article>
</div>
@endsection
