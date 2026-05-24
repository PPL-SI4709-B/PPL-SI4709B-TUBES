@extends('layouts.app')

@section('title', 'Approval Pengajuan')

@section('sidebar')
<x-dinas-sidebar active="pengajuan" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Approval Pengajuan</div>
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
                <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900);">Daftar Pengajuan</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">{{ $pengajuans->total() }} pengajuan masuk</div>
            </div>
        </div>

        @forelse ($pengajuans as $pengajuan)
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-5); margin-bottom: var(--space-3);">
                <div class="flex justify-between items-start">
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: var(--text-sm); color: var(--color-gray-900);">{{ $pengajuan->user->name }}</div>
                        <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">{{ $pengajuan->program->name }}</div>
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 4px;">{{ $pengajuan->created_at->format('d M Y') }}</div>
                    </div>
                    <div class="flex items-center gap-3 ml-4">
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
                        <span class="badge" style="background-color: {{ $statusColor['bg'] }}; color: {{ $statusColor['text'] }};">
                            {{ $statusLabel }}
                        </span>
                        <a href="{{ route('dinas.pengajuan.show', $pengajuan) }}" style="font-size: var(--text-sm); color: var(--color-secondary); font-weight: 500;">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: var(--space-12) 0; color: var(--color-text-muted);">
                <div style="font-size: var(--text-sm);">Belum ada pengajuan masuk.</div>
            </div>
        @endforelse

        @if ($pengajuans->hasPages())
            <div class="mt-4">
                {{ $pengajuans->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
