@extends('layouts.app')

@section('title', 'Detail Pengajuan Pendanaan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pendanaan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.pendanaan.index') }}" style="color: var(--color-text-muted); text-decoration: none;">Pengajuan Pendanaan</a>
        <span style="margin: 0 0.5rem;">&#8250;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Detail Pengajuan</span>
    </div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 48rem; margin: 0 auto;">

    @if(session('success'))
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500; border-left: 4px solid var(--color-success);">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div class="mb-4">
            <a href="{{ route('umkm.pendanaan.index') }}" style="font-size: var(--text-sm); color: var(--color-secondary, var(--color-primary));">← Kembali ke Riwayat</a>
        </div>

        <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900, #111827); margin-bottom: var(--space-6);">Detail Pengajuan Pendanaan</div>

        <div class="flex flex-col gap-4" style="margin-bottom: var(--space-6);">
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Status</div>
                <div style="margin-top: 4px;">
                    <x-pendanaan-status-badge :status="$pengajuanPendanaan->status" />
                </div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Pengajuan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 2px;">{{ $pengajuanPendanaan->submitted_at ? $pengajuanPendanaan->submitted_at->format('d M Y, H:i') : $pengajuanPendanaan->created_at->format('d M Y, H:i') }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Sumber Pendanaan</div>
                @if($pengajuanPendanaan->sumberPendanaan)
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 2px; font-weight: 600;">{{ $pengajuanPendanaan->sumberPendanaan->nama_program }}</div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 2px;">
                    Mitra: {{ $pengajuanPendanaan->sumberPendanaan->mitra_penyalur }} &middot; Batas Maksimal: Rp {{ number_format($pengajuanPendanaan->sumberPendanaan->batas_maksimal, 0, ',', '.') }}
                </div>
                @else
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 2px;">-</div>
                @endif
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Jumlah Pengajuan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 2px; font-weight: 700;">Rp {{ number_format($pengajuanPendanaan->jumlah_pengajuan, 0, ',', '.') }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tujuan Pendanaan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 2px;">{{ $pengajuanPendanaan->tujuan_pendanaan }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Deskripsi Kebutuhan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50, #f9fafb); border-radius: var(--radius-md); border: 1px solid var(--color-border); white-space: pre-line;">{{ $pengajuanPendanaan->deskripsi_kebutuhan }}</div>
            </div>
            @if($pengajuanPendanaan->dokumen_pendukung)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Dokumen Pendukung</div>
                <div style="margin-top: 4px;">
                    <a href="{{ route('pendanaan.dokumen', $pengajuanPendanaan) }}" target="_blank" style="font-size: var(--text-sm); color: var(--color-secondary, var(--color-primary)); text-decoration: underline;">
                        Lihat Dokumen ↗
                    </a>
                </div>
            </div>
            @endif
            @if($pengajuanPendanaan->catatan)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Catatan Petugas</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50, #f9fafb); border-radius: var(--radius-md); border: 1px solid var(--color-border);">{{ $pengajuanPendanaan->catatan }}</div>
            </div>
            @endif
            @if($pengajuanPendanaan->reviewed_at)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Review</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 2px;">{{ $pengajuanPendanaan->reviewed_at->format('d M Y, H:i') }}</div>
            </div>
            @endif
            @if($pengajuanPendanaan->reviewer)
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Direview Oleh</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900, #111827); margin-top: 2px;">{{ $pengajuanPendanaan->reviewer->name }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
