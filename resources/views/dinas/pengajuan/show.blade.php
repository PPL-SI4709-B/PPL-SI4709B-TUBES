@extends('layouts.app')

@section('title', 'Detail Pengajuan Program')

@section('sidebar')
<x-dinas-sidebar active="pengajuan" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Detail Pengajuan Program</div>
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
<div class="flex flex-col gap-6" style="max-width: 64rem; margin: 0 auto;">
    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <a href="{{ route('dinas.pengajuan.index') }}" class="link-action">Kembali ke Daftar Pengajuan</a>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-2);">Detail Pengajuan Program</h1>
            <p class="page-subtitle">Tinjau data pemohon, kebutuhan usaha, dokumen, dan keputusan pengajuan program.</p>
        </div>
        <x-status-badge :status="$pengajuan->status" />
    </div>

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); margin-bottom: var(--space-5); flex-wrap: wrap;">
            <div>
                <div class="page-kicker">Pengajuan Program</div>
                <h2 class="section-title" style="margin-top: var(--space-1);">{{ $pengajuan->program->name }}</h2>
                @if ($pengajuan->program->description)
                    <p class="section-subtitle">{{ $pengajuan->program->description }}</p>
                @endif
            </div>
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Tanggal Pengajuan</span>
                <div class="detail-value" style="font-weight: 800;">{{ $pengajuan->created_at->format('d M Y, H:i') }}</div>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-section">
                <div class="detail-label">Pemohon</div>
                <div class="detail-value" style="font-weight: 700;">{{ $pengajuan->user->name }}</div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted);">{{ $pengajuan->user->email }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Status</div>
                <div><x-status-badge :status="$pengajuan->status" /></div>
            </div>
        </div>

        <div class="detail-section" style="margin-top: var(--space-5);">
            <div class="detail-label">Kebutuhan Usaha</div>
            <div class="soft-panel" style="white-space: pre-line;">{{ $pengajuan->kebutuhan_usaha ?: 'Belum tersedia' }}</div>
        </div>

        <div class="detail-section" style="margin-top: var(--space-5);">
            <div class="detail-label">Dokumen Pendukung</div>
            @if ($pengajuan->dokumen_pendukung)
                <a href="{{ route('pengajuan.dokumen', $pengajuan) }}" target="_blank" class="btn btn-secondary" style="width: fit-content;">Lihat Dokumen</a>
            @else
                <div class="soft-panel" style="color: var(--color-text-muted);">Belum ada dokumen pendukung yang dilampirkan.</div>
            @endif
        </div>
    </section>

    @if ($pengajuan->status === 'pending')
        <section class="content-card" style="border-color: #bfdbfe;">
            <div style="margin-bottom: var(--space-5);">
                <h2 class="section-title">Panel Keputusan</h2>
                <p class="section-subtitle">Catatan opsional saat menyetujui, dan wajib diisi saat menolak pengajuan.</p>
            </div>

            <div class="form-group">
                <label for="notes" class="form-label">Catatan Petugas</label>
                @error('notes')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
                <textarea id="notes" name="notes" rows="4" class="form-control" style="resize: vertical;" placeholder="Tulis catatan untuk UMKM bila diperlukan."></textarea>
            </div>

            <div class="action-group" style="justify-content: flex-start; margin-top: var(--space-4);">
                <form action="{{ route('dinas.pengajuan.approve', $pengajuan) }}" method="POST" id="form-approve">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="notes" id="notes-approve">
                    <button type="submit" class="btn btn-primary" onclick="document.getElementById('notes-approve').value = document.getElementById('notes').value; return confirm('Setujui pengajuan ini?')">
                        Setujui Pengajuan
                    </button>
                </form>
                <form action="{{ route('dinas.pengajuan.reject', $pengajuan) }}" method="POST" id="form-reject">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="notes" id="notes-reject">
                    <button type="submit" class="btn btn-danger" onclick="document.getElementById('notes-reject').value = document.getElementById('notes').value; return confirm('Tolak pengajuan ini?')">
                        Tolak Pengajuan
                    </button>
                </form>
            </div>
        </section>
    @else
        <section class="content-card">
            <h2 class="section-title">Riwayat Peninjauan</h2>
            <p class="section-subtitle">Informasi petugas dan catatan keputusan pengajuan.</p>
            <div class="detail-grid" style="margin-top: var(--space-5);">
                <div class="detail-section">
                    <div class="detail-label">Catatan Petugas</div>
                    <div class="soft-panel" style="white-space: pre-line;">{{ $pengajuan->notes ?: 'Belum ada catatan' }}</div>
                </div>
                <div class="detail-section">
                    <div class="detail-label">Diproses Oleh</div>
                    <div class="detail-value">
                        <strong>{{ $pengajuan->reviewer?->name ?? 'Petugas' }}</strong>
                        @if ($pengajuan->reviewed_at)
                            <span style="color: var(--color-text-muted);">pada {{ $pengajuan->reviewed_at->format('d M Y, H:i') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
@endsection
