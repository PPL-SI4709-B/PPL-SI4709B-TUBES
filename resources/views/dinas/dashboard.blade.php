@extends('layouts.app')

@section('title', 'Dashboard Dinas - Portal UMKM')

@section('sidebar')
<x-dinas-sidebar active="dashboard" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Dashboard Monitoring Dinas</div>
        <div class="page-subtitle">Pantau verifikasi UMKM, pendanaan, event, dan laporan berkala dalam satu halaman.</div>
    </div>
    <div class="flex items-center gap-4">
        <a href="{{ route('dinas.dashboard.export-umkm') }}" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            Export UMKM
        </a>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff" alt="Avatar">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    <section class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Total UMKM</div>
                    <div class="stat-value">{{ $totalUmkm ?? 0 }}</div>
                </div>
                <div class="icon-chip">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </div>
            <div class="progress-track"><div class="progress-fill" style="width: {{ $verificationRate ?? 0 }}%;"></div></div>
            <div class="stat-note">{{ $verificationRate ?? 0 }}% UMKM sudah terverifikasi.</div>
            <a href="{{ route('dinas.verification.index') }}" class="link-action">Buka Verifikasi UMKM</a>
        </div>

        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Verifikasi Pendanaan</div>
                    <div class="stat-value">{{ $pendingPendanaan ?? 0 }}</div>
                </div>
                <div class="icon-chip gold">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"></path><circle cx="12" cy="12" r="9"></circle></svg>
                </div>
            </div>
            <div class="stat-note">{{ $approvedPendanaan ?? 0 }} disetujui, {{ $rejectedPendanaan ?? 0 }} ditolak.</div>
            <a href="{{ route('dinas.pendanaan-verifikasi.index') }}" class="link-action">Buka Verifikasi Pendanaan</a>
        </div>

        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Event dan Pelatihan</div>
                    <div class="stat-value">{{ $totalEvents ?? 0 }}</div>
                </div>
                <div class="icon-chip">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
            </div>
            <div class="stat-note">{{ $totalEventRegistrations ?? 0 }} total pendaftar event tercatat.</div>
            <a href="{{ route('dinas.event.index') }}" class="link-action">Kelola Event</a>
        </div>

        <div class="stat-card">
            <div class="stat-card-row">
                <div>
                    <div class="stat-label">Review Laporan Berkala</div>
                    <div class="stat-value">{{ $totalReports ?? 0 }}</div>
                </div>
                <div class="icon-chip">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                </div>
            </div>
            <div class="stat-note">Laporan berkala yang sudah dikirim oleh UMKM.</div>
            <a href="{{ route('dinas.report.index') }}" class="link-action">Review Laporan Berkala</a>
        </div>
    </section>

    <section class="dashboard-grid tight">
        <div class="content-card">
            <div class="stat-label">Master Data</div>
            <div class="detail-value" style="margin-top: var(--space-2);">Kategori, wilayah, dan skala usaha sebagai referensi portal.</div>
            <a href="{{ route('dinas.master-data') }}" class="link-action" style="display: inline-block; margin-top: var(--space-3);">Kelola Master Data</a>
        </div>
        <div class="content-card">
            <div class="stat-label">Sumber Pendanaan</div>
            <div class="stat-value" style="font-size: 1.6rem;">{{ $totalSumberPendanaan ?? 0 }}</div>
            <div class="stat-note">Program pendanaan yang dapat diajukan UMKM.</div>
            <a href="{{ route('dinas.sumber-pendanaan.index') }}" class="link-action">Kelola Sumber Pendanaan</a>
        </div>
        <div class="content-card">
            <div class="stat-label">UMKM Menunggu Verifikasi</div>
            <div class="stat-value" style="color: var(--color-warning);">{{ $pendingUmkm ?? 0 }}</div>
            <div class="stat-note">{{ $verifiedUmkm ?? 0 }} terverifikasi, {{ $rejectedUmkm ?? 0 }} ditolak.</div>
        </div>
    </section>

    <section class="dashboard-section-grid">
        <div class="content-card">
            <div class="stat-card-row" style="margin-bottom: var(--space-4);">
                <div>
                    <h2 class="section-title">Laporan Berkala Terbaru</h2>
                    <p class="section-subtitle">Laporan periodik yang sudah dikirim oleh UMKM.</p>
                </div>
                <a href="{{ route('dinas.report.index') }}" class="link-action">Lihat Semua</a>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>UMKM</th>
                            <th>Periode</th>
                            <th>Omzet</th>
                            <th>Karyawan</th>
                            <th style="text-align: right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentReports as $report)
                            <tr>
                                <td>
                                    <div style="font-weight: 700; color: var(--color-gray-900);">{{ $report->user?->umkmProfile?->business_name ?? $report->user?->name ?? 'Belum tersedia' }}</div>
                                    <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $report->user?->email ?? 'Belum tersedia' }}</div>
                                </td>
                                <td>{{ $report->kuartal }} {{ $report->tahun }}</td>
                                <td>{{ $report->omzet !== null ? 'Rp '.number_format($report->omzet, 0, ',', '.') : '-' }}</td>
                                <td>{{ $report->jumlah_karyawan !== null ? $report->jumlah_karyawan.' orang' : '-' }}</td>
                                <td style="text-align: right;"><a href="{{ route('dinas.report.show', $report->id) }}" class="link-action">Detail</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"><div class="empty-state">Belum ada laporan berkala masuk.</div></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="content-card">
            <h2 class="section-title">Sebaran Kategori UMKM</h2>
            <p class="section-subtitle">Ringkasan kategori usaha terdaftar.</p>
            <div class="flex flex-col gap-4" style="margin-top: var(--space-5);">
                @forelse ($categoryDistribution as $category => $count)
                    @php $percentage = ($totalUmkm ?? 0) > 0 ? round(($count / $totalUmkm) * 100) : 0; @endphp
                    <div>
                        <div class="flex justify-between" style="font-size: var(--text-sm); font-weight: 700; margin-bottom: var(--space-2);">
                            <span style="color: var(--color-gray-900);">{{ $category }}</span>
                            <span style="color: var(--color-text-muted);">{{ $count }}</span>
                        </div>
                        <div class="progress-track"><div class="progress-fill" style="width: {{ $percentage }}%;"></div></div>
                    </div>
                @empty
                    <div class="empty-state">Belum ada data profil UMKM.</div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
