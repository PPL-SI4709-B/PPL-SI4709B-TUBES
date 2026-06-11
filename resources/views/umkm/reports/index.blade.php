@extends('layouts.app')

@section('title', 'Laporan Perkembangan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="reports" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Beranda <span style="margin: 0 0.5rem;">&rsaquo;</span> <span style="color: var(--color-primary); font-weight: 700;">Laporan Perkembangan</span>
    </div>
    <div class="flex items-center gap-6">
        <div style="width: 1px; height: 32px; background-color: var(--color-border);"></div>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 68rem; margin: 0 auto;">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Laporan Usaha</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Laporan Perkembangan Usaha</h1>
            <p class="page-subtitle">Pantau status dan umpan balik Dinas atas laporan perkembangan yang Anda kirim.</p>
        </div>
        <a href="{{ route('reports.create') }}" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Buat Laporan Baru
        </a>
    </div>

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); margin-bottom: var(--space-4); flex-wrap: wrap;">
            <div>
                <h2 class="section-title">Riwayat Laporan</h2>
                <p class="section-subtitle">Catatan periode, kinerja keuangan, status, dan lampiran laporan.</p>
            </div>
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Total Laporan</span>
                <div class="detail-value" style="font-weight: 800;">{{ $reports->count() }}</div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Judul & Periode</th>
                        <th>Keuangan</th>
                        <th>Status</th>
                        <th>Catatan Dinas</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td>
                                <div style="font-weight: 800; color: var(--color-gray-900);">{{ $report->judul }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 2px;">Periode: {{ $report->period ? \Carbon\Carbon::parse($report->period)->translatedFormat('F Y') : 'Belum tersedia' }}</div>
                            </td>
                            <td style="white-space: nowrap;">
                                <div>Laba: <span style="font-weight: 800; color: {{ $report->profit >= 0 ? 'var(--color-success)' : 'var(--color-danger)' }};">Rp {{ number_format($report->profit, 0, ',', '.') }}</span></div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 2px;">Tanggal: {{ $report->report_date ? $report->report_date->format('d M Y') : 'Belum tersedia' }}</div>
                            </td>
                            <td>
                                <x-status-badge :status="$report->status" />
                            </td>
                            <td>
                                @if ($report->catatan_petugas)
                                    <p style="max-width: 22rem; color: var(--color-gray-900); margin: 0;">{{ $report->catatan_petugas }}</p>
                                @else
                                    <span style="font-size: var(--text-xs); color: var(--color-text-muted);">Belum ada catatan</span>
                                @endif
                                @if ($report->reviewed_at)
                                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 2px;">Ditinjau: {{ $report->reviewed_at->format('d M Y') }}</div>
                                @endif
                                @if ($report->lampiran)
                                    <a href="{{ route('reports.lampiran', $report) }}" target="_blank" class="link-action" style="font-size: var(--text-xs); margin-top: var(--space-1);">Lihat Lampiran</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <div class="icon-chip" style="margin: 0 auto var(--space-3);">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                                    </div>
                                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada laporan</h3>
                                    <p style="margin-bottom: var(--space-4);">Mulai kirim laporan perkembangan usaha agar Dinas dapat meninjau progres Anda.</p>
                                    <a href="{{ route('reports.create') }}" class="btn btn-primary">Buat Laporan Sekarang</a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
