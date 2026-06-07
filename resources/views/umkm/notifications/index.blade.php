@extends('layouts.app')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand flex items-center gap-3">
        <div style="background: white; border-radius: var(--radius-sm); padding: 0.25rem;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        </div>
        <div>
            <div class="brand-title" style="font-size: 1rem; line-height: 1.1;">PORTAL UMKM</div>
            <div class="brand-subtitle" style="font-size: 0.65rem; color: rgba(255,255,255,0.7);">KABUPATEN BANDUNG</div>
        </div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('umkm.dashboard') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
            Beranda
        </a>
        <a href="{{ route('umkm.pengajuan.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
            Pengajuan Program
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event &amp; Pelatihan
        </a>
        <a href="{{ route('reports.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
        <a href="{{ route('umkm.notifications.index') }}" class="nav-item active">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></span>
            Notifikasi
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
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Beranda <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Notifikasi &amp; Riwayat Status</span>
    </div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Notifikasi -->
        <div class="card p-0 flex flex-col h-full">
            <div class="p-6 border-b border-border">
                <h3 class="font-bold text-gray-900 text-lg">Notifikasi Baru</h3>
            </div>
            <div class="p-6 pt-0 flex-1 flex flex-col gap-4 mt-6">
                @forelse($notifications as $notification)
                    <div class="p-4 rounded-lg border {{ is_null($notification->read_at) ? 'border-primary bg-blue-50' : 'border-gray-200 bg-white' }}" style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            @php
                                $data = is_string($notification->data) ? json_decode($notification->data, true) : $notification->data;
                            @endphp
                            <h4 class="font-bold text-sm text-gray-900">{{ $data['title'] ?? 'Notifikasi' }}</h4>
                            <p class="text-xs text-gray-600 mt-1">{{ $data['message'] ?? '' }}</p>
                            <span class="text-[0.65rem] text-gray-400 mt-2 block">{{ $notification->created_at->diffForHumans() }}</span>
                        </div>
                        @if(is_null($notification->read_at))
                            <form action="{{ route('umkm.notifications.read', $notification->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="text-xs text-primary hover:underline font-medium">Tandai Dibaca</button>
                            </form>
                        @endif
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center p-8 text-center h-full">
                        <div style="background-color: #f1f5f9; padding: 1rem; border-radius: 50%; color: #94a3b8; margin-bottom: 1rem;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                        </div>
                        <p class="text-gray-500 font-medium text-sm">Tidak ada notifikasi saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Riwayat Status Pengajuan -->
        <div class="card p-0 flex flex-col h-full">
            <div class="p-6 border-b border-border">
                <h3 class="font-bold text-gray-900 text-lg">Riwayat Status Pengajuan</h3>
            </div>
            <div class="p-6 pt-0 flex-1 flex flex-col gap-4 mt-6 relative">
                @forelse($pengajuans as $pengajuan)
                    @php
                        $colors = match($pengajuan->status) {
                            'approved' => ['bg' => '#d1fae5', 'text' => '#059669'],
                            'rejected' => ['bg' => '#fee2e2', 'text' => '#dc2626'],
                            default    => ['bg' => '#fef3c7', 'text' => '#d97706'],
                        };
                        $label = match($pengajuan->status) {
                            'approved' => 'Disetujui',
                            'rejected' => 'Ditolak',
                            default    => 'Menunggu Verifikasi',
                        };
                    @endphp
                    <div class="p-4 rounded-lg border border-gray-200 relative z-10 bg-white">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-gray-500">{{ $pengajuan->program?->name ?? 'Pengajuan Pendanaan' }}</span>
                            <span style="display:inline-flex; align-items:center; background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; font-size: 0.65rem; font-weight: 700; padding: 0.2rem 0.6rem; border-radius: 99px; text-transform: uppercase;">
                                {{ $label }}
                            </span>
                        </div>
                        <p class="text-xs text-gray-600 mt-2">
                            @if($pengajuan->notes)
                                <strong>Catatan:</strong> {{ $pengajuan->notes }}
                            @else
                                Tidak ada catatan dari petugas.
                            @endif
                        </p>
                        <span class="text-[0.65rem] text-gray-400 mt-2 block">Diperbarui: {{ $pengajuan->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center p-8 text-center h-full">
                        <div style="background-color: #f1f5f9; padding: 1rem; border-radius: 50%; color: #94a3b8; margin-bottom: 1rem;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                        </div>
                        <p class="text-gray-500 font-medium text-sm">Belum ada riwayat pengajuan.</p>
                        <a href="{{ route('umkm.pengajuan.index') }}" class="btn btn-primary btn-sm mt-4">Buat Pengajuan</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
