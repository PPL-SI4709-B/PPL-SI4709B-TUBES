@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Timeline Perubahan Status Pengajuan</h1>
    
    <div class="bg-white p-6 rounded-lg shadow">
        @if(isset($logs) && $logs->count() > 0)
            <ol class="relative border-s border-gray-200">                  
                @foreach($logs as $log)
                <li class="mb-10 ms-4">
                    <div class="absolute w-3 h-3 bg-blue-600 rounded-full mt-1.5 -start-1.5 border border-white"></div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400">{{ $log->created_at->format('d M Y H:i') }}</time>
                    <h3 class="text-lg font-semibold text-gray-900">Status: {{ ucfirst($log->status) }}</h3>
                    <p class="mb-4 text-base font-normal text-gray-500">
                        {{ $log->catatan ?? 'Tidak ada catatan' }}
                    </p>
                    <p class="text-sm font-medium text-gray-600">
                        Oleh: {{ $log->user ? $log->user->name : 'Sistem' }}
                    </p>
                </li>
                @endforeach
            </ol>
        @else
            <div class="text-center py-8 text-gray-500">
                <p class="mb-4">Belum ada data. <a href="{{ route('umkm.dashboard') }}" class="text-blue-600 hover:underline">Mulai sekarang</a></p>
            </div>
        @endif
    </div>
</div>
@endsection
