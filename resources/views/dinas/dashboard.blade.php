@extends('layouts.app')

@section('sidebar')
<x-dinas-sidebar active="dashboard" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Dashboard Monitoring Dinas</div>
        <div class="text-sm text-gray-500 mt-1">Rekap UMKM, pengajuan, laporan, dan export data</div>
    </div>
    <div class="flex items-center gap-4">
        <a href="{{ route('dinas.dashboard.export-umkm') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Export UMKM
        </a>
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
<div class="flex flex-col gap-6">
    <div class="grid grid-cols-4 gap-6">
        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-3">Total UMKM</div>
            <div class="flex items-end justify-between">
                <div class="text-4xl font-extrabold text-gray-900">{{ $totalUmkm }}</div>
                <div class="badge badge-approved">{{ $verificationRate }}% verified</div>
            </div>
            <div class="mt-4" style="height: 8px; background: #e5e7eb; border-radius: 999px; overflow: hidden;">
                <div style="height: 100%; width: {{ $verificationRate }}%; background: #16a34a;"></div>
            </div>
        </div>

        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-3">Pengajuan Program</div>
            <div class="flex items-end justify-between">
                <div class="text-4xl font-extrabold text-gray-900">{{ $totalPengajuan }}</div>
                <div class="badge badge-pending">{{ $pendingApproval }} perlu review</div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-2 text-xs font-semibold">
                <span style="color: #16a34a;">{{ $approvedPengajuan }} disetujui</span>
                <span style="color: #d97706;">{{ $pendingApproval }} pending</span>
                <span style="color: #dc2626;">{{ $rejectedPengajuan }} ditolak</span>
            </div>
        </div>

        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-3">Laporan UMKM</div>
            <div class="flex items-end justify-between">
                <div class="text-4xl font-extrabold text-gray-900">{{ $totalReports }}</div>
                <div class="badge badge-approved">{{ $reportReviewRate }}% direview</div>
            </div>
            <div class="mt-4 text-sm text-gray-600">{{ $pendingReports }} laporan menunggu catatan petugas</div>
        </div>

        <div class="card p-6">
            <div class="text-xs font-bold text-gray-500 uppercase mb-3">Verifikasi UMKM</div>
            <div class="grid grid-cols-3 gap-3">
                <div>
                    <div class="text-2xl font-bold" style="color: #16a34a;">{{ $verifiedUmkm }}</div>
                    <div class="text-xs text-gray-500">Terverifikasi</div>
                </div>
                <div>
                    <div class="text-2xl font-bold" style="color: #d97706;">{{ $pendingUmkm }}</div>
                    <div class="text-xs text-gray-500">Pending</div>
                </div>
                <div>
                    <div class="text-2xl font-bold" style="color: #dc2626;">{{ $rejectedUmkm }}</div>
                    <div class="text-xs text-gray-500">Ditolak</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="card p-6 col-span-2">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">Rekap Pengajuan Terbaru</h3>
                    <p class="text-sm text-gray-500">Monitoring antrean approval terbaru dari UMKM</p>
                </div>
                <a href="{{ route('dinas.pengajuan.index') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Lihat Semua</a>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>UMKM</th>
                            <th>Program</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentPengajuans as $pengajuan)
                            <tr>
                                <td class="font-bold text-gray-900">{{ $pengajuan->user?->name ?? '-' }}</td>
                                <td class="text-gray-600">{{ $pengajuan->program?->name ?? '-' }}</td>
                                <td class="text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                                <td><x-status-badge :status="$pengajuan->status" /></td>
                                <td style="text-align: right;">
                                    <a href="{{ route('dinas.pengajuan.show', $pengajuan) }}" style="color: var(--color-secondary); font-size: var(--text-sm);">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: var(--space-8); color: var(--color-text-muted);">
                                    Belum ada pengajuan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card p-6">
            <h3 class="font-bold text-gray-900 text-lg mb-5">Sebaran Kategori UMKM</h3>
            <div class="flex flex-col gap-4">
                @forelse ($categoryDistribution as $category => $count)
                    @php $percentage = $totalUmkm > 0 ? round(($count / $totalUmkm) * 100) : 0; @endphp
                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-2">
                            <span class="text-gray-700">{{ $category }}</span>
                            <span class="text-gray-500">{{ $count }}</span>
                        </div>
                        <div style="height: 8px; background: #e5e7eb; border-radius: 999px; overflow: hidden;">
                            <div style="height: 100%; width: {{ $percentage }}%; background: #2563eb;"></div>
                        </div>
                    </div>
                @empty
                    <div style="padding: var(--space-8); text-align: center; color: var(--color-text-muted); font-size: var(--text-sm);">
                        Belum ada data profil UMKM.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">
        <div class="card p-6">
            <h3 class="font-bold text-gray-900 text-lg mb-5">Program Paling Banyak Diajukan</h3>
            <div class="flex flex-col gap-3">
                @forelse ($topPrograms as $program)
                    <div class="flex items-center justify-between" style="padding: 0.875rem 0; border-bottom: 1px solid var(--color-border);">
                        <div>
                            <div class="font-semibold text-gray-900">{{ $program->name }}</div>
                            <div class="text-xs text-gray-500">{{ ucfirst($program->jenis) }} · {{ ucfirst($program->status) }}</div>
                        </div>
                        <div class="text-xl font-bold text-gray-900">{{ $program->pengajuans_count }}</div>
                    </div>
                @empty
                    <div style="padding: var(--space-8); text-align: center; color: var(--color-text-muted); font-size: var(--text-sm);">
                        Belum ada program dengan pengajuan.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="card p-6 col-span-2">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg">Rekap Laporan Terbaru</h3>
                    <p class="text-sm text-gray-500">Laporan perkembangan usaha yang perlu dipantau petugas</p>
                </div>
                <a href="{{ route('dinas.report.index') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Review Laporan</a>
            </div>
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>UMKM</th>
                            <th>Judul</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReports as $report)
                            <tr>
                                <td class="font-bold text-gray-900">{{ $report->user?->name ?? '-' }}</td>
                                <td class="text-gray-600">{{ $report->judul }}</td>
                                <td class="text-gray-600">{{ $report->created_at->format('d M Y') }}</td>
                                <td><x-status-badge :status="$report->status" /></td>
                                <td style="text-align: right;">
                                    <a href="{{ route('dinas.report.show', $report) }}" style="color: var(--color-secondary); font-size: var(--text-sm);">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: var(--space-8); color: var(--color-text-muted);">
                                    Belum ada laporan UMKM.
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
