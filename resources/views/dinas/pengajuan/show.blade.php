@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>

    <nav class="nav-menu">
        <a href="{{ route('dinas.dashboard') }}" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            </span>
            Beranda
        </a>
        <a href="{{ route('dinas.program.index') }}" class="nav-item">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
            </span>
            Kelola Program
        </a>
        <a href="{{ route('dinas.pengajuan.index') }}" class="nav-item active">
            <span class="nav-icon">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            </span>
            Approval Pengajuan
        </a>
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</aside>
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Detail Pengajuan</div>
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

    <div class="card" style="padding: var(--space-6);">
        <div class="mb-4">
            <a href="{{ route('dinas.pengajuan.index') }}" style="font-size: var(--text-sm); color: var(--color-secondary);">← Kembali</a>
        </div>

        <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-6);">Detail Pengajuan</div>

        <div class="flex flex-col gap-4" style="margin-bottom: var(--space-6);">
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Pemohon</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $pengajuan->user->name }}</div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $pengajuan->user->email }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Program</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $pengajuan->program->name }}</div>
                @if ($pengajuan->program->description)
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 2px;">{{ $pengajuan->program->description }}</div>
                @endif
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Pengajuan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $pengajuan->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Status</div>
                @php
                    $statusColor = match($pengajuan->status) {
                        'approved' => ['bg' => 'var(--color-success-bg)', 'text' => 'var(--color-success)'],
                        'rejected' => ['bg' => '#fef2f2', 'text' => 'var(--color-danger)'],
                        default    => ['bg' => '#fffbeb', 'text' => '#b45309'],
                    };
                    $statusLabel = match($pengajuan->status) {
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default    => 'Pending',
                    };
                @endphp
                <div style="margin-top: 4px;">
                    <span class="badge" style="background-color: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }};">
                        {{ $statusLabel }}
                    </span>
                </div>
            </div>
        </div>

        @if ($pengajuan->status === 'pending')
            <div class="flex flex-col gap-4">
                <div>
                    <label for="notes" style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: var(--space-1);">Catatan (opsional)</label>
                    <textarea id="notes" name="notes" rows="3" style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;" placeholder="Tulis catatan untuk UMKM..."></textarea>
                </div>
                <div class="flex gap-3">
                    <form action="{{ route('dinas.pengajuan.approve', $pengajuan) }}" method="POST" id="form-approve">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="notes" id="notes-approve">
                        <button type="submit" class="btn btn-primary" onclick="document.getElementById('notes-approve').value = document.getElementById('notes').value; return confirm('Setujui pengajuan ini?')">
                            Setujui
                        </button>
                    </form>
                    <form action="{{ route('dinas.pengajuan.reject', $pengajuan) }}" method="POST" id="form-reject">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="notes" id="notes-reject">
                        <button type="submit" style="background-color: var(--color-danger); color: white; padding: var(--space-2) var(--space-4); border-radius: var(--radius-md); border: none; cursor: pointer; font-size: var(--text-sm); font-weight: 500;" onclick="document.getElementById('notes-reject').value = document.getElementById('notes').value; return confirm('Tolak pengajuan ini?')">
                            Tolak
                        </button>
                    </form>
                </div>
            </div>
        @else
            @if ($pengajuan->notes)
                <div style="margin-bottom: var(--space-4);">
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Catatan Petugas</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50); border-radius: var(--radius-md); border: 1px solid var(--color-border);">{{ $pengajuan->notes }}</div>
                </div>
            @endif
            <div style="font-size: var(--text-sm); color: var(--color-text-muted);">Pengajuan ini sudah diproses.</div>
        @endif
    </div>

</div>
@endsection
