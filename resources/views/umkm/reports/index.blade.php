@extends('layouts.app')

@section('title', 'Laporan Perkembangan - Portal UMKM')

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
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Profil Usaha
        </a>
        <a href="#" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg></span>
            Pengajuan Program
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event &amp; Pelatihan
        </a>
        <a href="{{ route('reports.index') }}" class="nav-item active">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Beranda <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Laporan Perkembangan</span>
    </div>
    <div class="flex items-center gap-6">
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">{{ ucfirst(Auth::user()->role) }}</div>
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

    {{-- Success / Error Flash --}}
    @if (session('success'))
    <div style="background-color: var(--color-success-bg); border-left: 4px solid var(--color-success); padding: 1rem 1.25rem; border-radius: var(--radius-md); color: #166534; font-size: 0.875rem; font-weight: 500;">
        {{ session('success') }}
    </div>
    @endif

    {{-- Page Header --}}
    <div class="card p-0 overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <div>
                <h1 class="font-bold text-gray-900 text-lg">Laporan Perkembangan Usaha</h1>
                <p class="text-sm text-gray-500 mt-1">Pantau status dan umpan balik dari Dinas atas laporan yang Anda ajukan.</p>
            </div>
            <a href="{{ route('reports.create') }}" class="btn" style="background-color: var(--color-primary); color: white; display: flex; align-items: center; gap: 0.5rem; border-radius: var(--radius-md);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Buat Laporan Baru
            </a>
        </div>

        <div class="table-container p-6 pt-0">
            <table class="table" style="margin-top: -1px;">
                <thead>
                    <tr>
                        <th style="padding-top: var(--space-4);">JUDUL & PERIODE</th>
                        <th style="padding-top: var(--space-4);">KEUANGAN</th>
                        <th style="padding-top: var(--space-4);">STATUS</th>
                        <th style="padding-top: var(--space-4);">CATATAN DINAS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                    <tr>
                        <td>
                            <div class="font-bold text-gray-900">{{ $report->judul }}</div>
                            <div class="text-xs text-gray-500 mt-1">Periode: {{ $report->period ? \Carbon\Carbon::parse($report->period)->translatedFormat('F Y') : '-' }}</div>
                        </td>
                        <td class="text-gray-600" style="white-space: nowrap;">
                            <div class="text-sm">Laba: <span class="font-bold {{ $report->profit >= 0 ? 'text-green-600' : 'text-red-600' }}">Rp {{ number_format($report->profit, 0, ',', '.') }}</span></div>
                            <div class="text-xs text-gray-500 mt-1">Tgl Laporan: {{ $report->report_date ? $report->report_date->format('d M Y') : '-' }}</div>
                        </td>
                        <td>
                            @if ($report->status === 'approved')
                                <span style="display:inline-flex; align-items:center; background-color: var(--color-success-bg); color: var(--color-success); font-size: 0.65rem; font-weight: 800; padding: 0.25rem 0.6rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                    Disetujui
                                </span>
                            @elseif ($report->status === 'rejected')
                                <span style="display:inline-flex; align-items:center; background-color: #fef2f2; color: #dc2626; font-size: 0.65rem; font-weight: 800; padding: 0.25rem 0.6rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                    Ditolak
                                </span>
                            @else
                                <span style="display:inline-flex; align-items:center; background-color: #fefce8; color: #d97706; font-size: 0.65rem; font-weight: 800; padding: 0.25rem 0.6rem; border-radius: 99px; letter-spacing: 0.05em; text-transform: uppercase;">
                                    Menunggu
                                </span>
                            @endif
                        </td>
                        <td>
                            @if ($report->catatan_petugas)
                                <p class="text-sm text-gray-700" style="max-width: 20rem;">{{ $report->catatan_petugas }}</p>
                            @else
                                <span class="text-xs text-gray-400 italic">Belum ada catatan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 3rem 1rem;">
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 0.75rem; color: var(--color-text-muted);">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="color: #cbd5e1;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                <div>
                                    <p class="font-semibold text-gray-600" style="font-size: 0.9rem;">Belum ada laporan</p>
                                    <p class="text-sm text-gray-400 mt-1">Mulai ajukan laporan perkembangan usaha Anda.</p>
                                </div>
                                <a href="{{ route('reports.create') }}" class="btn" style="background-color: var(--color-primary); color: white; margin-top: 0.5rem;">
                                    Buat Laporan Sekarang
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
