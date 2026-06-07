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
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-center mb-6">
            <div>
                <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900);">Daftar Program</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">{{ $programs->total() }} program terdaftar</div>
            </div>
            <a href="{{ route('dinas.program.create') }}" class="btn btn-primary">
                + Tambah Program
            </a>
        </div>

        @forelse ($programs as $program)
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-5); margin-bottom: var(--space-3);">
                <div class="flex justify-between items-start">
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: var(--text-sm); color: var(--color-gray-900);">{{ $program->name }}</div>
                        @if ($program->description)
                            <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 4px;">{{ Str::limit($program->description, 100) }}</div>
                        @endif
                        <div class="flex gap-4 mt-3" style="font-size: var(--text-xs); color: var(--color-text-muted);">
                            <span>Kuota: <strong>{{ $program->quota }}</strong></span>
                            @if ($program->start_date)
                                <span>Mulai: <strong>{{ $program->start_date->format('d M Y') }}</strong></span>
                            @endif
                            @if ($program->end_date)
                                <span>Selesai: <strong>{{ $program->end_date->format('d M Y') }}</strong></span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-3 ml-4">
                        <span class="badge" style="background-color: {{ $program->status === 'active' ? 'var(--color-success-bg)' : '#f1f5f9' }}; color: {{ $program->status === 'active' ? 'var(--color-success)' : 'var(--color-text-muted)' }};">
                            {{ $program->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        <a href="{{ route('dinas.program.show', $program) }}" style="font-size: var(--text-sm); color: var(--color-text-muted); font-weight: 500;">Detail</a>
                        <a href="{{ route('dinas.program.edit', $program) }}" style="font-size: var(--text-sm); color: var(--color-secondary); font-weight: 500;">Edit</a>
                        <form action="{{ route('dinas.program.destroy', $program) }}" method="POST" onsubmit="return confirm('Hapus program ini?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="font-size: var(--text-sm); color: var(--color-danger); font-weight: 500; background: none; border: none; cursor: pointer;">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: var(--space-12) 0; color: var(--color-text-muted);">
                <div style="font-size: var(--text-sm); margin-bottom: var(--space-3);">Belum ada program.</div>
                <a href="{{ route('dinas.program.create') }}" class="btn btn-primary">Tambah Program Pertama</a>
            </div>
        @endforelse

        @if ($programs->hasPages())
            <div class="mt-4">
                {{ $programs->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
