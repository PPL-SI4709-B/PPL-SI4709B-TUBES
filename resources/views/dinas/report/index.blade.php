@extends('layouts.app')

@section('title', 'Review Laporan Berkala')

@section('sidebar')
<x-dinas-sidebar active="report" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Review Laporan Berkala</div>
        <div class="page-subtitle">Tinjau laporan berkala yang dikirim UMKM melalui menu Laporan Berkala.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Review Laporan Berkala</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Daftar UMKM Pelapor</h1>
            <p class="page-subtitle">Pilih UMKM untuk melihat riwayat laporan berkala yang telah dikirim.</p>
        </div>
        <div style="display: flex; gap: var(--space-3); flex-wrap: wrap;">
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Total UMKM Pelapor</span>
                <div class="detail-value" style="font-weight: 800;">{{ $umkmReports->count() }}</div>
            </div>
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Total Laporan</span>
                <div class="detail-value" style="font-weight: 800;">{{ $totalReports }}</div>
            </div>
        </div>
    </div>

    <section class="content-card">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama UMKM/Toko</th>
                        <th>Pemilik/Email</th>
                        <th>Jumlah Laporan</th>
                        <th>Periode Terbaru</th>
                        <th>Terakhir Dikirim</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($umkmReports as $item)
                        @php
                            $user = $item->user;
                            $latestReport = $item->latestReport;
                        @endphp
                        <tr>
                            <td>
                                <div style="font-weight: 800; color: var(--color-gray-900);">{{ $user?->umkmProfile?->business_name ?? $user?->name ?? 'Belum tersedia' }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $user?->umkmProfile?->business_address ?? 'Alamat belum tersedia' }}</div>
                            </td>
                            <td>
                                <div style="font-weight: 700; color: var(--color-gray-900);">{{ $user?->name ?? 'Belum tersedia' }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $user?->email ?? 'Belum tersedia' }}</div>
                            </td>
                            <td>{{ $item->reportsCount }}</td>
                            <td style="white-space: nowrap;">{{ $latestReport?->kuartal }} {{ $latestReport?->tahun }}</td>
                            <td style="white-space: nowrap;">{{ $latestReport?->updated_at?->format('d M Y') ?? '-' }}</td>
                            <td style="text-align: right;">
                                @if($user)
                                    <a href="{{ route('dinas.report.umkm', $user->id) }}" class="link-action">Lihat Laporan</a>
                                @else
                                    <span class="stat-note">Data user tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada laporan berkala masuk</h3>
                                    <p>Laporan berkala akan muncul setelah UMKM mengirim laporan dari menu Laporan Berkala.</p>
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
