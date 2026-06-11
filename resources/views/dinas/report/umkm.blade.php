@extends('layouts.app')

@section('title', 'Riwayat Laporan Berkala UMKM')

@section('sidebar')
<x-dinas-sidebar active="report" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Review Laporan Berkala</div>
        <div class="page-subtitle">Riwayat laporan berkala berdasarkan UMKM pelapor.</div>
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
    <div class="page-header">
        <div>
            <a href="{{ route('dinas.report.index') }}" class="link-action">Kembali ke Daftar UMKM Pelapor</a>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-2);">
                {{ $user->umkmProfile?->business_name ?? $user->name }}
            </h1>
            <p class="page-subtitle">{{ $user->name }} · {{ $user->email }}</p>
        </div>
        <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
            <span class="detail-label">Jumlah Laporan</span>
            <div class="detail-value" style="font-weight: 800;">{{ $reports->count() }}</div>
        </div>
    </div>

    <section class="content-card">
        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-label">Nama UMKM/Toko</div>
                <div class="detail-value" style="font-weight: 700;">{{ $user->umkmProfile?->business_name ?? 'Belum tersedia' }}</div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $user->umkmProfile?->business_address ?? 'Alamat belum tersedia' }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Kategori / Wilayah / Skala</div>
                <div class="detail-value">
                    {{ $user->umkmProfile?->category?->name ?? 'Kategori belum tersedia' }} /
                    {{ $user->umkmProfile?->region?->name ?? 'Wilayah belum tersedia' }} /
                    {{ $user->umkmProfile?->scale?->name ?? 'Skala belum tersedia' }}
                </div>
            </div>
        </div>
    </section>

    <section class="content-card">
        <div style="margin-bottom: var(--space-5);">
            <h2 class="section-title">Riwayat Laporan Berkala</h2>
            <p class="section-subtitle">Laporan yang sudah dikirim oleh UMKM ini.</p>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Periode</th>
                        <th>Omzet</th>
                        <th>Karyawan</th>
                        <th>Dikirim</th>
                        <th>Kendala</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td style="white-space: nowrap;">{{ $report->kuartal }} {{ $report->tahun }}</td>
                            <td>{{ $report->omzet !== null ? 'Rp '.number_format($report->omzet, 0, ',', '.') : '-' }}</td>
                            <td>{{ $report->jumlah_karyawan !== null ? $report->jumlah_karyawan.' orang' : '-' }}</td>
                            <td style="white-space: nowrap;">{{ $report->updated_at->format('d M Y') }}</td>
                            <td>{{ $report->kendala ? \Illuminate\Support\Str::limit($report->kendala, 80) : '-' }}</td>
                            <td style="text-align: right;">
                                <a href="{{ route('dinas.report.show', $report->id) }}" class="link-action">Detail Periode</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
