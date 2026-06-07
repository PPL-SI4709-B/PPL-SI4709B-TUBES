@extends('layouts.app')

@section('title', 'Detail Laporan')

@section('sidebar')
<x-dinas-sidebar active="report" />
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
            @if ($report->lampiran)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Lampiran</div>
                <div style="margin-top: 4px;">
                    <a href="{{ route('reports.lampiran', $report) }}" target="_blank" style="font-size: var(--text-sm); color: var(--color-secondary); text-decoration: underline;">Lihat Lampiran ↗</a>
                </div>
            </div>
            @endif
            @if ($report->reviewed_at)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Riwayat Review</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">Ditinjau oleh <strong>{{ $report->reviewer?->name ?? 'Petugas' }}</strong> pada {{ $report->reviewed_at->format('d M Y, H:i') }}</div>
            </div>
            @endif
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
