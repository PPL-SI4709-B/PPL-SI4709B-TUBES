@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('sidebar')
<x-dinas-sidebar active="pengajuan" />
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
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Kebutuhan Usaha</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50); border-radius: var(--radius-md); border: 1px solid var(--color-border); white-space: pre-line;">{{ $pengajuan->kebutuhan_usaha }}</div>
            </div>
            @if ($pengajuan->dokumen_pendukung)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Dokumen Pendukung</div>
                <div style="margin-top: 4px;">
                    <a href="{{ Storage::url($pengajuan->dokumen_pendukung) }}" target="_blank" style="font-size: var(--text-sm); color: var(--color-secondary); text-decoration: underline;">
                        Lihat Dokumen ↗
                    </a>
                </div>
            </div>
            @endif
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Pengajuan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $pengajuan->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Status</div>
                <div style="margin-top: 4px;">
                    <x-status-badge :status="$pengajuan->status" />
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
