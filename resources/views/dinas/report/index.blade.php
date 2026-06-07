@extends('layouts.app')

@section('title', 'Review Laporan')

@section('sidebar')
<x-dinas-sidebar active="report" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Review Laporan UMKM</div>
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
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-6);">
            Daftar Laporan
            <span style="font-size: var(--text-sm); font-weight: 500; color: var(--color-text-muted); margin-left: var(--space-2);">{{ $reports->total() }} laporan</span>
        </div>

        @forelse ($reports as $report)
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
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4); margin-bottom: var(--space-3); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-weight: 600; font-size: var(--text-sm); color: var(--color-gray-900);">{{ $report->judul }}</div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $report->user?->name }} &bull; {{ $report->created_at->format('d M Y') }}</div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="badge" style="background-color: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }};">{{ $statusLabel }}</span>
                    <a href="{{ route('dinas.report.show', $report) }}" style="font-size: var(--text-sm); color: var(--color-secondary); font-weight: 500;">Review</a>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: var(--space-8) 0; color: var(--color-text-muted); font-size: var(--text-sm);">
                Belum ada laporan masuk.
            </div>
        @endforelse

        @if ($reports->hasPages())
            <div class="mt-4">{{ $reports->links() }}</div>
        @endif
    </div>

</div>
@endsection
