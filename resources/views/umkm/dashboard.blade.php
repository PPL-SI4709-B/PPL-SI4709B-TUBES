@extends('layouts.app')

@section('sidebar')
<x-umkm-sidebar active="dashboard" />
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

    @if(session('success'))
        <div style="background-color: var(--color-success-bg); border-left: 4px solid var(--color-success); padding: 1.25rem 1.5rem; border-radius: var(--radius-md); color: #166534; font-size: 0.875rem; font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::user()->profile_status === 'pending')
        <div class="card p-0" style="background-color: #fefce8; border-color: transparent;">
            <div class="flex items-center justify-between" style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-warning);">
                <div class="flex items-center gap-4">
                    <div style="background-color: rgba(245,158,11,0.2); padding: 0.5rem; border-radius: var(--radius-sm); color: var(--color-warning);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold" style="color: #854d0e;">Profil Anda belum diverifikasi</h3>
                        <p class="text-sm" style="color: #a16207;">Tunggu petugas Dinas memverifikasi akun Anda. Pastikan profil usaha sudah lengkap.</p>
                    </div>
                </div>
                <a href="{{ route('umkm.profile.show') }}" style="font-size: var(--text-sm); font-weight: 600; color: #854d0e; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">
                    Cek Profil →
                </a>
            </div>
        </div>
    @elseif(Auth::user()->profile_status === 'rejected')
        <div class="card p-0" style="background-color: #fef2f2; border-color: transparent;">
            <div style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-danger); display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 class="text-base font-bold" style="color: #991b1b;">Verifikasi ditolak</h3>
                    <p class="text-sm" style="color: #b91c1c;">Profil Anda ditolak oleh petugas Dinas. Perbarui data profil dan hubungi petugas.</p>
                </div>
                <a href="{{ route('umkm.profile.edit') }}" style="font-size: var(--text-sm); font-weight: 600; color: #991b1b; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">
                    Edit Profil →
                </a>
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
                        <tr>
                            <td class="font-bold text-gray-900">{{ $pengajuan->program?->name ?? '-' }}</td>
                            <td class="text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td style="text-align: right;">
                                <x-status-badge :status="$pengajuan->status" />
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
                        <tr>
                            <td class="font-bold text-gray-900">{{ $report->judul }}</td>
                            <td class="text-gray-600">{{ $report->created_at->format('d M Y') }}</td>
                            <td style="text-align: right;">
                                <x-status-badge :status="$report->status" />
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
