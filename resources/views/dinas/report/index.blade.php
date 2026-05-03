@extends('layouts.app')

@section('title', 'Review Laporan')

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
        <a href="{{ route('dinas.verification.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Verifikasi UMKM
        </a>
        <a href="{{ route('dinas.program.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span>
            Kelola Program
        </a>
        <a href="{{ route('dinas.pengajuan.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Approval Pengajuan
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
