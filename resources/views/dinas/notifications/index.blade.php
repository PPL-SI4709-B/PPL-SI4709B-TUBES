@extends('layouts.app')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('dinas.dashboard') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></span>
            Beranda
        </a>
        <a href="{{ route('dinas.verification.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Verifikasi UMKM
        </a>
        <a href="{{ route('dinas.program.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span>
            Kelola Program
        </a>
        <a href="{{ route('dinas.pengajuan.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Approval Pengajuan
        </a>
    </nav>
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Notifikasi</div>
    <div class="flex items-center gap-6">
        <!-- Bell Icon -->
        <div class="relative">
            <a href="{{ route('dinas.notifications.index') }}" class="text-gray-500 hover:text-gray-700">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                @php
                    $unreadCount = \App\Models\Notification::where('user_id', Auth::id())->whereNull('read_at')->count();
                @endphp
                @if($unreadCount > 0)
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">{{ $unreadCount }}</span>
                @endif
            </a>
        </div>
        
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=2563eb&color=fff" alt="Avatar">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="card p-6">
    <h3 class="font-bold text-gray-900 text-lg mb-4">Daftar Notifikasi</h3>
    <div class="flex flex-col gap-4">
        @forelse($notifications as $notification)
            <div class="p-4 border rounded-md {{ $notification->read_at ? 'bg-white' : 'bg-blue-50' }}">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-sm font-semibold text-gray-500 uppercase">{{ str_replace('_', ' ', $notification->type) }}</span>
                        <p class="text-gray-900 mt-1">
                            @if(isset($notification->data['message']))
                                {{ $notification->data['message'] }}
                            @else
                                Notifikasi baru.
                            @endif
                        </p>
                        <span class="text-xs text-gray-400 mt-2 block">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    @if(!$notification->read_at)
                        <form action="{{ route('dinas.notifications.markAsRead', $notification) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="text-sm text-blue-600 hover:underline">Tandai sudah dibaca</button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-gray-500">
                <p>Belum ada notifikasi.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
