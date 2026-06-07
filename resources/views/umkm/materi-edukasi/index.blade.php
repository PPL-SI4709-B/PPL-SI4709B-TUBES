@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Materi Edukasi</h1>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($materi as $item)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col">
                @if($item->thumbnail_path)
                    <img src="{{ Storage::url($item->thumbnail_path) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                @endif
                
                <div class="p-6 flex-1 flex flex-col">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $item->title }}</h3>
                    <p class="text-gray-600 mb-4 flex-1">{{ Str::limit($item->description, 100) }}</p>
                    
                    <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('umkm.materi-edukasi.show', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            Baca Detail &rarr;
                        </a>
                        <a href="{{ route('umkm.materi-edukasi.download', $item->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded text-sm font-medium transition-colors">
                            Unduh
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada materi edukasi</h3>
                    <p class="text-gray-500">Materi edukasi akan ditambahkan oleh Petugas Dinas. Silakan kembali lagi nanti.</p>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $materi->links() }}
    </div>
</div>
@endsection
