@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('dinas.dashboard') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></span>
            Beranda
        </a>
        <a href="{{ route('dinas.report.index') }}" class="nav-item active">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Review Laporan
        </a>
    </nav>
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Detail Laporan</div>
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

    <div class="card" style="padding: var(--space-6);">
        <div class="mb-4">
            <a href="{{ route('dinas.report.index') }}" style="font-size: var(--text-sm); color: var(--color-secondary);">← Kembali</a>
        </div>

        <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-6);">{{ $report->judul }}</div>

        <div class="flex flex-col gap-4" style="margin-bottom: var(--space-6);">
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Pelapor</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $report->user?->name }}</div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $report->user?->email }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $report->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Deskripsi</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px; line-height: 1.6;">{{ $report->deskripsi }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Status</div>
                @php
                    $statusColor = match($report->status) {
                        'approved' => ['bg' => 'var(--color-success-bg)', 'text' => 'var(--color-success)'],
                        'rejected' => ['bg' => '#fef2f2', 'text' => 'var(--color-danger)'],
                        default    => ['bg' => '#fffbeb', 'text' => '#b45309'],
                    };
                    $statusLabel = match($report->status) {
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default    => 'Pending',
                    };
                @endphp
                <div style="margin-top: 4px;">
                    <span class="badge" style="background-color: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }};">{{ $statusLabel }}</span>
                </div>
            </div>
        </div>

        @if ($report->status === 'pending')
            <form action="{{ route('dinas.report.update', $report) }}" method="POST" class="flex flex-col gap-4">
                @csrf
                @method('PUT')

                <div>
                    <label style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: var(--space-1);">Keputusan</label>
                    <select name="status" required style="padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm);">
                        <option value="approved">Setujui</option>
                        <option value="rejected">Tolak</option>
                    </select>
                </div>

                <div>
                    <label style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: var(--space-1);">Catatan Petugas (opsional)</label>
                    <textarea name="catatan_petugas" rows="3" style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;" placeholder="Tulis catatan..."></textarea>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Simpan Keputusan</button>
                </div>
            </form>
        @else
            @if($report->catatan_petugas)
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Catatan Petugas</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50); border-radius: var(--radius-md); border: 1px solid var(--color-border);">{{ $report->catatan_petugas }}</div>
                </div>
            @endif
            <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: var(--space-4);">Laporan ini sudah diproses.</div>
        @endif
    </div>

</div>
@endsection
