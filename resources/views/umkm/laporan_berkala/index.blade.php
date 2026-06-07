@extends('layouts.app')

@section('title', 'Laporan Perkembangan Usaha')

@section('sidebar')
    <aside class="sidebar sidebar-light">
        <div class="sidebar-brand">
            <h1 class="brand-title">Portal UMKM</h1>
            <p class="brand-subtitle">Kabupaten Bandung</p>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('umkm.dashboard') }}" class="nav-item">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                </div>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('umkm.pengajuan.index') }}" class="nav-item">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                </div>
                <span>Pengajuan Pendanaan</span>
            </a>
            <a href="{{ route('umkm.laporan_berkala.index') }}" class="nav-item active">
                <div class="nav-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg>
                </div>
                <span>Laporan Berkala</span>
            </a>
        </nav>
        <div class="sidebar-bottom">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn w-full justify-start" style="background: none; border: none; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    <span>Keluar</span>
                </button>
            </form>
        </div>
    </aside>
@endsection

@section('header')
    <header class="main-header">
        <h2 class="page-title">Laporan Perkembangan Usaha Berkala</h2>
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ Auth::user()->role }}</div>
            </div>
            <div class="user-avatar">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
        </div>
    </header>
@endsection

@section('content')
    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(count($chartLabels) > 0)
        <div class="bg-white shadow sm:rounded-md p-6 mb-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Grafik Perkembangan Omzet</h3>
            <div class="relative w-full" style="height: 300px;">
                <canvas id="omzetChart"></canvas>
            </div>
        </div>
        @endif

        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-lg font-medium leading-6 text-gray-900">Daftar Laporan Anda</h3>
                <p class="mt-1 text-sm text-gray-500">Laporan perkembangan usaha dikirim setiap kuartal.</p>
            </div>
            <a href="{{ route('umkm.laporan_berkala.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">
                Buat Laporan Baru
            </a>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-md mt-6">
            <ul class="divide-y divide-gray-200">
                @forelse ($laporans as $laporan)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-medium text-blue-600 truncate">
                                    Laporan Kuartal {{ $laporan->kuartal }} - Tahun {{ $laporan->tahun }}
                                </p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    @if($laporan->status === 'draft')
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            Draft
                                        </p>
                                    @else
                                        <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Terkirim
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="flex items-center text-sm text-gray-500">
                                        Omzet: {{ $laporan->omzet !== null ? 'Rp ' . number_format($laporan->omzet, 0, ',', '.') : '-' }}
                                    </p>
                                    <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                        Karyawan: {{ $laporan->jumlah_karyawan !== null ? $laporan->jumlah_karyawan . ' Orang' : '-' }}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                    @if($laporan->status === 'draft')
                                        <a href="{{ route('umkm.laporan_berkala.edit', $laporan->id) }}" class="text-blue-600 hover:text-blue-900 mr-4 text-sm font-medium">Lanjutkan Draft</a>
                                    @endif
                                    <p>
                                        {{ $laporan->status === 'draft' ? 'Diperbarui' : 'Dikirim' }} pada {{ $laporan->updated_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li>
                        <div class="px-4 py-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada laporan</h3>
                            <p class="mt-1 text-sm text-gray-500">Anda belum mengirim laporan perkembangan usaha apapun.</p>
                            <div class="mt-6">
                                <a href="{{ route('umkm.laporan_berkala.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Mulai sekarang
                                </a>
                            </div>
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>
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
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: 'rgb(59, 130, 246)'
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
