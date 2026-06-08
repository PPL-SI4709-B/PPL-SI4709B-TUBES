@extends('layouts.app')

@section('title', 'Detail Materi Edukasi - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="materi-edukasi" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.materi-edukasi.index') }}" style="color: var(--color-text-muted); text-decoration: none;">Materi Edukasi</a>
        <span style="margin: 0 0.5rem;">&#8250;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Detail</span>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('umkm.materi-edukasi.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-1 text-sm font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Materi
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        @if($materiEdukasi->thumbnail_path)
            <img src="{{ Storage::url($materiEdukasi->thumbnail_path) }}" alt="{{ $materiEdukasi->title }}" class="w-full h-64 md:h-96 object-cover">
        @endif
        
        <div class="p-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $materiEdukasi->title }}</h1>
                    <p class="text-sm text-gray-500">Dipublikasikan pada {{ $materiEdukasi->created_at->format('d M Y') }}</p>
                </div>
                <a href="{{ route('umkm.materi-edukasi.download', $materiEdukasi->id) }}" class="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    Unduh Materi
                </a>
            </div>

            <div class="prose max-w-none text-gray-700">
                {!! nl2br(e($materiEdukasi->description)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
