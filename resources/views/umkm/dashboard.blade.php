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
        <a href="{{ route('umkm.dashboard') }}" class="nav-item active">
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
        Beranda <span style="margin: 0 0.5rem;">&#8250;</span> <span style="color: var(--color-primary); font-weight: 700;">Dashboard Utama</span>
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

    @if(Auth::user()->profile_status === 'pending')
        <div class="card p-0" style="background-color: #fefce8; border-color: transparent;">
            <div class="flex items-center justify-between" style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-warning);">
                <div class="flex items-center gap-4">
                    <div style="background-color: rgba(245,158,11,0.2); padding: 0.5rem; border-radius: var(--radius-sm); color: var(--color-warning);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold" style="color: #854d0e;">Profil Anda belum diverifikasi</h3>
                        <p class="text-sm" style="color: #a16207;">Tunggu petugas memverifikasi akun Anda untuk dapat mengajukan program.</p>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->profile_status === 'rejected')
        <div class="card p-0" style="background-color: #fef2f2; border-color: transparent;">
            <div style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-danger);">
                <h3 class="text-base font-bold" style="color: #991b1b;">Verifikasi ditolak</h3>
                <p class="text-sm" style="color: #b91c1c;">Hubungi petugas dinas untuk informasi lebih lanjut.</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-3 gap-6">
        <div class="card p-6 flex gap-4 items-center" style="padding: var(--space-5);">
            <div style="background-color: #f1f5f9; padding: 0.75rem; border-radius: var(--radius-md); color: var(--color-primary);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><polyline points="9 15 11 17 15 12"></polyline></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">TOTAL PENGAJUAN</div>
                <div class="text-3xl font-bold text-gray-900">{{ $totalPengajuan }}</div>
            </div>
        </div>

        <div class="card p-6 flex gap-4 items-center" style="padding: var(--space-5);">
            <div style="background-color: var(--color-success-bg); padding: 0.75rem; border-radius: var(--radius-md); color: var(--color-success);">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">DISETUJUI</div>
                <div class="text-3xl font-bold" style="color: var(--color-success);">{{ $pengajuanStatus->get('approved', 0) }}</div>
            </div>
        </div>

        <div class="card p-6 flex gap-4 items-center" style="padding: var(--space-5);">
            <div style="background-color: #faf5ff; padding: 0.75rem; border-radius: var(--radius-md); color: #9333ea;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">LAPORAN TERKIRIM</div>
                <div class="text-3xl font-bold" style="color: #9333ea;">{{ $totalLaporan }}</div>
            </div>
        </div>
    </div>

    <div class="card p-0 overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="font-bold text-gray-900 text-lg">Pengajuan Terbaru</h3>
            <a href="{{ route('umkm.pengajuan.index') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Lihat Semua &rarr;</a>
        </div>
        <div class="table-container p-6 pt-0">
            <table class="table" style="margin-top: -1px;">
                <thead>
                    <tr>
                        <th style="padding-top: var(--space-4);">PROGRAM</th>
                        <th style="padding-top: var(--space-4);">TANGGAL</th>
                        <th style="padding-top: var(--space-4); text-align: right;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentPengajuans as $pengajuan)
                        @php
                            $colors = match($pengajuan->status) {
                                'approved' => ['bg' => '#d1fae5', 'text' => '#059669'],
                                'rejected' => ['bg' => '#fee2e2', 'text' => '#dc2626'],
                                default    => ['bg' => '#fef3c7', 'text' => '#d97706'],
                            };
                            $label = match($pengajuan->status) {
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                default    => 'Menunggu',
                            };
                        @endphp
                        <tr>
                            <td class="font-bold text-gray-900">{{ $pengajuan->program?->name ?? '-' }}</td>
                            <td class="text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td style="text-align: right;">
                                <span style="display:inline-flex; align-items:center; background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 99px; text-transform: uppercase;">
                                    {{ $label }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: var(--space-8); color: var(--color-text-muted); font-size: var(--text-sm);">
                                Belum ada pengajuan. <a href="{{ route('umkm.pengajuan.index') }}" style="color: var(--color-primary); font-weight: 600;">Ajukan sekarang</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card p-0 overflow-hidden mb-6">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="font-bold text-gray-900 text-lg">Laporan Terbaru</h3>
            <a href="{{ route('reports.index') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Lihat Semua &rarr;</a>
        </div>
        <div class="table-container p-6 pt-0">
            <table class="table" style="margin-top: -1px;">
                <thead>
                    <tr>
                        <th style="padding-top: var(--space-4);">JUDUL</th>
                        <th style="padding-top: var(--space-4);">TANGGAL</th>
                        <th style="padding-top: var(--space-4); text-align: right;">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentReports as $report)
                        @php
                            $colors = match($report->status) {
                                'approved' => ['bg' => '#d1fae5', 'text' => '#059669'],
                                'rejected' => ['bg' => '#fee2e2', 'text' => '#dc2626'],
                                default    => ['bg' => '#fef3c7', 'text' => '#d97706'],
                            };
                            $label = match($report->status) {
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                default    => 'Menunggu',
                            };
                        @endphp
                        <tr>
                            <td class="font-bold text-gray-900">{{ $report->judul }}</td>
                            <td class="text-gray-600">{{ $report->created_at->format('d M Y') }}</td>
                            <td style="text-align: right;">
                                <span style="display:inline-flex; align-items:center; background-color: {{ $colors['bg'] }}; color: {{ $colors['text'] }}; font-size: 0.7rem; font-weight: 700; padding: 0.25rem 0.75rem; border-radius: 99px; text-transform: uppercase;">
                                    {{ $label }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center; padding: var(--space-8); color: var(--color-text-muted); font-size: var(--text-sm);">
                                Belum ada laporan. <a href="{{ route('reports.create') }}" style="color: var(--color-primary); font-weight: 600;">Buat laporan</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
