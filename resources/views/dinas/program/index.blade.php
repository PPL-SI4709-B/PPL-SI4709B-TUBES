@extends('layouts.app')

@section('title', 'Kelola Program')

@section('sidebar')
<x-dinas-sidebar active="program" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Kelola Program</div>
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

    <div class="page-header">
        <div>
            <div class="page-kicker">Master Program</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Daftar Program</h1>
            <p class="page-subtitle">{{ $programs->total() }} program terdaftar untuk pengajuan UMKM.</p>
        </div>
        <a href="{{ route('dinas.program.create') }}" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            Tambah Program
        </a>
    </div>

    <section class="content-card">
        <div class="flex flex-col gap-3">
            @forelse ($programs as $program)
                <div class="list-card">
                    <div style="flex: 1; min-width: 0;">
                        <div style="display: flex; align-items: center; gap: var(--space-3); flex-wrap: wrap;">
                            <h2 style="font-weight: 800; font-size: var(--text-base); color: var(--color-gray-900); margin: 0;">{{ $program->name }}</h2>
                            <span class="badge {{ $program->status === 'active' ? 'badge-success' : 'badge-secondary' }}">
                                {{ $program->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        @if ($program->description)
                            <p style="font-size: var(--text-sm); color: var(--color-text-muted); margin: var(--space-2) 0 0; line-height: 1.6;">{{ \Illuminate\Support\Str::limit($program->description, 120) }}</p>
                        @endif
                        <div style="display: flex; gap: var(--space-4); flex-wrap: wrap; margin-top: var(--space-3); font-size: var(--text-xs); color: var(--color-text-muted);">
                            <span>Kuota: <strong style="color: var(--color-gray-900);">{{ $program->quota }}</strong></span>
                            @if ($program->start_date)
                                <span>Mulai: <strong style="color: var(--color-gray-900);">{{ $program->start_date->format('d M Y') }}</strong></span>
                            @endif
                            @if ($program->end_date)
                                <span>Selesai: <strong style="color: var(--color-gray-900);">{{ $program->end_date->format('d M Y') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="action-group">
                        <a href="{{ route('dinas.program.show', $program) }}" class="link-action">Detail</a>
                        <a href="{{ route('dinas.program.edit', $program) }}" class="link-action">Edit</a>
                        <form action="{{ route('dinas.program.destroy', $program) }}" method="POST" onsubmit="return confirm('Hapus program ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="font-size: var(--text-sm); color: var(--color-danger); font-weight: 700; background: none; border: none; cursor: pointer;">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada program</h3>
                    <p style="margin-bottom: var(--space-4);">Tambahkan program pertama agar UMKM dapat mengajukan partisipasi.</p>
                    <a href="{{ route('dinas.program.create') }}" class="btn btn-primary">Tambah Program Pertama</a>
                </div>
            @endforelse
        </div>

        @if ($programs->hasPages())
            <div style="margin-top: var(--space-4);">
                {{ $programs->links() }}
            </div>
        @endif
    </section>
</div>
@endsection
