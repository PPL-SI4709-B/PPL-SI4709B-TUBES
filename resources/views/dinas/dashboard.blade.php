@extends('layouts.app')

@section('sidebar')
<x-dinas-sidebar active="dashboard" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Dashboard Dinas</div>
    <div class="flex items-center gap-6">
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
        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: #f1f5f9; padding: 0.5rem; border-radius: var(--radius-md); color: var(--color-primary);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">TOTAL UMKM TERDAFTAR</div>
            <div class="text-3xl font-bold text-gray-900">{{ $totalUmkm }}</div>
        </div>

        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: var(--color-success-bg); padding: 0.5rem; border-radius: var(--radius-md); color: var(--color-success);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                </div>
                <div class="badge" style="background-color: var(--color-success-bg); color: var(--color-success);">Terverifikasi</div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">UMKM TERVERIFIKASI</div>
            <div class="text-3xl font-bold text-gray-900">{{ $verifiedUmkm }}</div>
        </div>

        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: #fff7ed; padding: 0.5rem; border-radius: var(--radius-md); color: #ea580c;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </div>
                @if($pendingApproval > 0)
                    <div class="badge" style="background-color: #ffedd5; color: #c2410c;">{{ $pendingApproval }} Pending</div>
                @endif
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">PENGAJUAN MASUK</div>
            <div class="text-3xl font-bold text-gray-900">{{ $totalPengajuan }}</div>
        </div>

        <div class="card p-6" style="padding: var(--space-5) var(--space-6);">
            <div class="flex justify-between items-start mb-4">
                <div style="background-color: #fef3c7; padding: 0.5rem; border-radius: var(--radius-md); color: #d97706;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                </div>
            </div>
            <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-1">MENUNGGU VERIFIKASI</div>
            <div class="text-3xl font-bold text-gray-900">{{ $pendingUmkm }}</div>
        </div>
    </div>

    <div class="card p-0 overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b border-border">
            <h3 class="font-bold text-gray-900 text-lg">Pengajuan Terbaru</h3>
            <a href="{{ route('dinas.pengajuan.index') }}" class="text-sm font-semibold" style="color: var(--color-secondary);">Lihat Semua &rarr;</a>
        </div>
        <div class="table-container p-6 pt-0">
            <table class="table" style="margin-top: -1px;">
                <thead>
                    <tr>
                        <th style="padding-top: var(--space-4);">NAMA UMKM</th>
                        <th style="padding-top: var(--space-4);">PROGRAM</th>
                        <th style="padding-top: var(--space-4);">TANGGAL</th>
                        <th style="padding-top: var(--space-4);">STATUS</th>
                        <th style="padding-top: var(--space-4); text-align: right;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentPengajuans as $pengajuan)
                        @php
                            $statusColor = match($pengajuan->status) {
                                'approved' => 'badge-approved',
                                'rejected' => 'badge-rejected',
                                default    => 'badge-pending',
                            };
                            $statusLabel = match($pengajuan->status) {
                                'approved' => 'Disetujui',
                                'rejected' => 'Ditolak',
                                default    => 'Menunggu',
                            };
                        @endphp
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div style="width: 28px; height: 28px; background: #bfdbfe; color: #1e40af; border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem;">
                                        {{ strtoupper(substr($pengajuan->user?->name ?? '?', 0, 2)) }}
                                    </div>
                                    <span class="font-bold text-gray-900">{{ $pengajuan->user?->name ?? '-' }}</span>
                                </div>
                            </td>
                            <td class="text-gray-600">{{ $pengajuan->program?->name ?? '-' }}</td>
                            <td class="text-gray-600">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td><span class="badge {{ $statusColor }}">{{ $statusLabel }}</span></td>
                            <td style="text-align: right;">
                                <a href="{{ route('dinas.pengajuan.show', $pengajuan) }}" style="color: var(--color-secondary); font-size: var(--text-sm);">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: var(--space-8); color: var(--color-text-muted); font-size: var(--text-sm);">
                                Belum ada pengajuan masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
