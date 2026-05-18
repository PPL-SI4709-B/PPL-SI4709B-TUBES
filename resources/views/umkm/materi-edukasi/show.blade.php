@extends('layouts.app')

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
