@extends('layouts.app')

@section('title', 'Laporan Berkala - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="laporan-berkala" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">Laporan Berkala</div>
        <div class="page-subtitle">Kelola laporan perkembangan usaha per kuartal.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="support-page">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Perkembangan Usaha</div>
            <h1>Laporan Perkembangan Usaha Berkala</h1>
            <p class="page-subtitle">Kirim laporan omzet, jumlah karyawan, kendala, dan rencana usaha setiap kuartal.</p>
        </div>
        <a href="{{ route('umkm.laporan_berkala.create') }}" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Buat Laporan Baru
        </a>
    </div>

    @if(count($chartLabels) > 0)
        <section class="content-card">
            <div class="stat-card-row" style="margin-bottom: var(--space-5);">
                <div>
                    <h2 class="section-title">Grafik Perkembangan Omzet</h2>
                    <p class="section-subtitle">Ringkasan omzet berdasarkan laporan yang sudah Anda simpan.</p>
                </div>
            </div>
            <div style="height: 300px;">
                <canvas id="omzetChart"></canvas>
            </div>
        </section>
    @endif

    <section class="content-card">
        <div class="stat-card-row" style="margin-bottom: var(--space-5);">
            <div>
                <h2 class="section-title">Daftar Laporan Anda</h2>
                <p class="section-subtitle">Laporan perkembangan usaha dikirim setiap kuartal.</p>
            </div>
        </div>

        <div class="section-list">
            @forelse ($laporans as $laporan)
                <article class="list-card support-list-card">
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; align-items: center; gap: var(--space-3); flex-wrap: wrap;">
                            <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin: 0;">
                                Laporan Kuartal {{ $laporan->kuartal }} - Tahun {{ $laporan->tahun }}
                            </h3>
                            @if($laporan->status === 'draft')
                                <span class="badge badge-warning">Draft</span>
                            @else
                                <span class="badge badge-success">Terkirim</span>
                            @endif
                        </div>
                        <div class="support-meta" style="margin-top: var(--space-3);">
                            <span>Omzet: <strong style="color: var(--color-gray-900);">{{ $laporan->omzet !== null ? 'Rp ' . number_format($laporan->omzet, 0, ',', '.') : '-' }}</strong></span>
                            <span>Karyawan: <strong style="color: var(--color-gray-900);">{{ $laporan->jumlah_karyawan !== null ? $laporan->jumlah_karyawan . ' Orang' : '-' }}</strong></span>
                            <span>{{ $laporan->status === 'draft' ? 'Diperbarui' : 'Dikirim' }} pada {{ $laporan->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>

                    @if($laporan->status === 'draft')
                        <a href="{{ route('umkm.laporan_berkala.edit', $laporan->id) }}" class="btn btn-secondary" style="white-space: nowrap;">Lanjutkan Draft</a>
                    @endif
                </article>
            @empty
                <div class="support-empty-state">
                    <span class="support-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    </span>
                    <h3>Belum ada laporan</h3>
                    <p>Anda belum mengirim laporan perkembangan usaha apapun.</p>
                    <div style="margin-top: var(--space-5);">
                        <a href="{{ route('umkm.laporan_berkala.create') }}" class="btn btn-primary">Mulai sekarang</a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
</div>

@if(count($chartLabels) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('omzetChart').getContext('2d');
        const chartData = @json($chartData);
        const chartLabels = @json($chartLabels);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Omzet Usaha (Rp)',
                    data: chartData,
                    borderColor: '#15803D',
                    backgroundColor: 'rgba(21, 128, 61, 0.10)',
                    tension: 0.3,
                    fill: true,
                    pointBackgroundColor: '#064E3B'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += 'Rp ' + new Intl.NumberFormat('id-ID').format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endif
@endsection
