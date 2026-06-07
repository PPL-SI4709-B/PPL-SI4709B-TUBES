@extends('layouts.app')

@section('sidebar')
<x-umkm-sidebar active="dashboard" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Dashboard UMKM</div>
        <div class="text-sm text-gray-500 mt-1">Ringkasan aktivitas dan status usaha</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    @if(session('success'))
        <div style="background-color: var(--color-success-bg); border-left: 4px solid var(--color-success); padding: 1.25rem 1.5rem; border-radius: var(--radius-md); color: #166534; font-size: 0.875rem; font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    @if(Auth::user()->profile_status === 'pending')
        <div class="card p-0" style="background-color: #fefce8; border-color: transparent;">
            <div class="flex items-center justify-between" style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-warning);">
                <div>
                    <h3 class="text-base font-bold" style="color: #854d0e;">Profil Anda menunggu verifikasi</h3>
                    <p class="text-sm" style="color: #a16207;">Lengkapi profil usaha agar petugas dapat memverifikasi data Anda.</p>
                </div>
                <a href="{{ route('umkm.profile.show') }}" style="font-size: var(--text-sm); font-weight: 600; color: #854d0e; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">Cek Profil</a>
            </div>
        </div>
    @elseif(Auth::user()->profile_status === 'rejected')
        <div class="card p-0" style="background-color: #fef2f2; border-color: transparent;">
            <div class="flex items-center justify-between" style="padding: 1.25rem 1.5rem; border-left: 4px solid var(--color-danger);">
                <div>
                    <h3 class="text-base font-bold" style="color: #991b1b;">Verifikasi profil ditolak</h3>
                    <p class="text-sm" style="color: #b91c1c;">Perbarui data profil agar bisa diajukan ulang untuk verifikasi.</p>
                </div>
                <a href="{{ route('umkm.profile.edit') }}" style="font-size: var(--text-sm); font-weight: 600; color: #991b1b; text-decoration: underline; white-space: nowrap; margin-left: 1rem;">Edit Profil</a>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-2 gap-6" style="grid-template-columns: repeat(4, 1fr);">
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
            <div class="mt-8 grid grid-cols-4 gap-4">
                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: var(--radius-md); padding: 1rem;">
                    <div class="text-3xl font-bold">{{ $totalPengajuan }}</div>
                    <div class="text-sm mt-1" style="color: #d1d5db;">Total Pengajuan</div>
                </div>
                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: var(--radius-md); padding: 1rem;">
                    <div class="text-3xl font-bold">{{ $approvedPengajuan }}</div>
                    <div class="text-sm mt-1" style="color: #d1d5db;">Pengajuan Disetujui</div>
                </div>
                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: var(--radius-md); padding: 1rem;">
                    <div class="text-3xl font-bold">{{ $totalLaporan }}</div>
                    <div class="text-sm mt-1" style="color: #d1d5db;">Laporan Terkirim</div>
                </div>
                <div style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: var(--radius-md); padding: 1rem;">
                    <div class="text-3xl font-bold">{{ $totalPendanaan }}</div>
                    <div class="text-sm mt-1" style="color: #d1d5db;">Total Pendanaan</div>
                </div>
            </div>
        </div>

        <div class="card p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <div class="text-xs font-bold text-gray-500 uppercase">Kelengkapan Profil</div>
                    <div class="text-4xl font-extrabold text-gray-900 mt-2">{{ $profileCompleteness }}%</div>
                </div>
                <a href="{{ route('umkm.profile.edit') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Edit</a>
            </div>
            <div style="height: 10px; background: #e5e7eb; border-radius: 999px; overflow: hidden;">
                <div style="height: 100%; width: {{ $profileCompleteness }}%; background: #2563eb;"></div>
            </div>
            <p class="text-sm text-gray-500 mt-4">Lengkapi identitas, kategori, wilayah, dan skala agar proses verifikasi lebih cepat.</p>
        </div>

        <div class="card p-6 flex gap-4 items-center" style="padding: var(--space-5);">
            <div style="background-color: #ecfdf5; padding: 0.75rem; border-radius: var(--radius-md); color: #16a34a;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22"></path><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <div>
                <div class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">PENDANAAN</div>
                <div class="text-3xl font-bold" style="color: #16a34a;">{{ $totalPendanaan }}</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-6">
        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-2">Menunggu</div>
            <div class="text-3xl font-extrabold" style="color: #d97706;">{{ $pendingPengajuan }}</div>
            <div class="text-sm text-gray-500 mt-2">Pengajuan sedang direview</div>
        </div>
        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-2">Disetujui</div>
            <div class="text-3xl font-extrabold" style="color: #16a34a;">{{ $approvedPengajuan }}</div>
            <div class="text-sm text-gray-500 mt-2">Pengajuan berhasil</div>
        </div>
        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-2">Ditolak</div>
            <div class="text-3xl font-extrabold" style="color: #dc2626;">{{ $rejectedPengajuan }}</div>
            <div class="text-sm text-gray-500 mt-2">Perlu evaluasi ulang</div>
        </div>
        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-2">Laporan Direview</div>
            <div class="text-3xl font-extrabold" style="color: #2563eb;">{{ $reviewedReports }}</div>
            <div class="text-sm text-gray-500 mt-2">Sudah diberi catatan</div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-6">
        <div class="card p-0 overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-border">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">Pengajuan Terbaru</h3>
                    <p class="text-sm text-gray-500">Status program yang Anda ajukan</p>
                </div>
                <a href="{{ route('umkm.pengajuan.index') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Lihat Semua</a>
            </div>
            <div class="table-container p-6 pt-0">
                <table class="table" style="margin-top: -1px;">
                    <thead>
                        <tr>
                            <th style="padding-top: var(--space-4);">Program</th>
                            <th style="padding-top: var(--space-4);">Tanggal</th>
                            <th style="padding-top: var(--space-4); text-align: right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentPengajuans as $pengajuan)
                            <tr>
                                <td class="font-bold text-gray-900">{{ $pengajuan->program?->name ?? '-' }}</td>
                                <td class="text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                                <td style="text-align: right;"><x-status-badge :status="$pengajuan->status" /></td>
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

        <div class="card p-0 overflow-hidden">
            <div class="flex justify-between items-center p-6 border-b border-border">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">Laporan Terbaru</h3>
                    <p class="text-sm text-gray-500">Aktivitas pelaporan perkembangan usaha</p>
                </div>
                <a href="{{ route('reports.index') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Lihat Semua</a>
            </div>
            <div class="table-container p-6 pt-0">
                <table class="table" style="margin-top: -1px;">
                    <thead>
                        <tr>
                            <th style="padding-top: var(--space-4);">Judul</th>
                            <th style="padding-top: var(--space-4);">Tanggal</th>
                            <th style="padding-top: var(--space-4); text-align: right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReports as $report)
                            <tr>
                                <td class="font-bold text-gray-900">{{ $report->judul }}</td>
                                <td class="text-gray-600">{{ $report->created_at->format('d M Y') }}</td>
                                <td style="text-align: right;"><x-status-badge :status="$report->status" /></td>
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
</div>
@endsection
