@extends('layouts.app')

@section('title', 'Detail Program')

@section('sidebar')
<x-dinas-sidebar active="program" />
@endsection

@section('header')
<header class="main-header">
    <div class="flex items-center gap-3">
        <a href="{{ route('dinas.program.index') }}" style="color: var(--color-text-muted);">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <div class="page-title">Detail Program</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()?->name }}</div>
            <div class="user-role">PETUGAS DINAS</div>
        </div>
        <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
        </div>
    </div>
</header>
@endsection

@section('content')
<div style="max-width: 640px;">
    <div class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-start" style="margin-bottom: var(--space-6);">
            <div>
                <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900);">{{ $program->name }}</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">Program {{ ucfirst($program->jenis) }}</div>
            </div>
            <span class="badge" style="background-color: {{ $program->status === 'active' ? 'var(--color-success-bg)' : '#f1f5f9' }}; color: {{ $program->status === 'active' ? 'var(--color-success)' : 'var(--color-text-muted)' }};">
                {{ $program->status === 'active' ? 'Aktif' : 'Nonaktif' }}
            </span>
        </div>

        <div class="flex flex-col gap-4">
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Deskripsi</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px; white-space: pre-line;">{{ $program->description ?? '-' }}</div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Kuota Peserta</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px;">{{ $program->quota }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Jumlah Pengajuan</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px;">{{ $program->pengajuans_count }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Mulai</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px;">{{ $program->start_date?->format('d M Y') ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Selesai</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px;">{{ $program->end_date?->format('d M Y') ?? '-' }}</div>
                </div>
            </div>
        </div>

        <div class="flex gap-3 justify-end" style="margin-top: var(--space-6);">
            <a href="{{ route('dinas.program.index') }}" class="btn" style="background-color: #f1f5f9; color: var(--color-text);">Kembali</a>
            <a href="{{ route('dinas.program.edit', $program) }}" class="btn btn-primary">Edit Program</a>
        </div>
    </div>
</div>
@endsection
