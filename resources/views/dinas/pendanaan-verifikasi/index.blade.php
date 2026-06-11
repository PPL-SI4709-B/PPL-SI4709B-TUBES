@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan Pendanaan')

@section('sidebar')
<x-dinas-sidebar active="pendanaan-verifikasi" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Verifikasi Pengajuan Pendanaan</div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()?->name }}</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Verifikasi Pendanaan</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Daftar Pengajuan Pendanaan</h1>
            <p class="page-subtitle">Verifikasi pengajuan pendanaan UMKM dan berikan keputusan administratif.</p>
        </div>
        <form method="GET" action="{{ route('dinas.pendanaan-verifikasi.index') }}" class="soft-panel" style="padding: var(--space-3) var(--space-4); min-width: 16rem;">
            <label for="status" class="detail-label">Status</label>
            <select id="status" name="status" onchange="this.form.submit()" class="form-control" style="margin-top: var(--space-2);">
                <option value="">Semua Status</option>
                @foreach ($allowedStatuses as $status)
                    <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: center; gap: var(--space-4); margin-bottom: var(--space-4); flex-wrap: wrap;">
            <div>
                <h2 class="section-title">Pengajuan Ditemukan</h2>
                <p class="section-subtitle">{{ $pengajuans->total() }} pengajuan sesuai filter saat ini.</p>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Pemohon</th>
                        <th>Usaha</th>
                        <th>Sumber Pendanaan</th>
                        <th style="text-align: right;">Jumlah</th>
                        <th style="text-align: center;">Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengajuans as $pengajuan)
                        @php
                            $profile = $pengajuan->user?->umkmProfile;
                        @endphp
                        <tr>
                            <td style="white-space: nowrap;">{{ ($pengajuan->submitted_at ?? $pengajuan->created_at)->format('d M Y') }}</td>
                            <td>
                                <div style="font-weight: 700; color: var(--color-gray-900);">{{ $pengajuan->user?->name ?? 'Belum tersedia' }}</div>
                                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $pengajuan->user?->email ?? 'Belum tersedia' }}</div>
                            </td>
                            <td>{{ $profile?->business_name ?? 'Belum tersedia' }}</td>
                            <td>{{ $pengajuan->sumberPendanaan?->nama_program ?? 'Belum tersedia' }}</td>
                            <td style="text-align: right; white-space: nowrap; font-weight: 800; color: var(--color-gray-900);">Rp {{ number_format($pengajuan->jumlah_pengajuan, 0, ',', '.') }}</td>
                            <td style="text-align: center;">
                                <x-pendanaan-status-badge :status="$pengajuan->status" />
                            </td>
                            <td style="text-align: center;">
                                <a href="{{ route('dinas.pendanaan-verifikasi.show', $pengajuan) }}" class="link-action">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada pengajuan pendanaan</h3>
                                    <p>Data pengajuan akan muncul setelah UMKM mengirim formulir pendanaan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($pengajuans->hasPages())
            <div style="margin-top: var(--space-4);">
                {{ $pengajuans->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
