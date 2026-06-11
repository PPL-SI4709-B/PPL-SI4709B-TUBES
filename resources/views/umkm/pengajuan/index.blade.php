@extends('layouts.app')

@section('title', 'Pengajuan Program - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pengajuan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Pengajuan Program <span style="margin: 0 0.5rem;">&rsaquo;</span> <span style="color: var(--color-primary); font-weight: 700;">Riwayat & Status</span>
    </div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
            </div>
            <div class="user-avatar" style="background-color: transparent;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
@php
    $isVerified = Auth::user()->profile_status === 'verified';
@endphp

<div class="flex flex-col gap-6" style="max-width: 68rem; margin: 0 auto;">
    <div class="page-header">
        <div>
            <div class="page-kicker">Program UMKM</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Pengajuan Program</h1>
            <p class="page-subtitle">Ajukan program pembinaan atau fasilitasi dan pantau hasil review dari Dinas.</p>
        </div>
        @if($programsPendanaan->isNotEmpty() && $isVerified)
            <button type="button" onclick="openModal()" class="btn btn-primary">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Ajukan Program
            </button>
        @endif
    </div>

    @if(!$isVerified)
        <div class="alert alert-warning" style="display: flex; justify-content: space-between; align-items: center; gap: var(--space-4); flex-wrap: wrap;">
            <span><strong>Akun belum diverifikasi.</strong> Lengkapi profil usaha agar pengajuan program dapat dikirim.</span>
            <a href="{{ route('umkm.profile.show') }}" class="link-action">Cek Profil</a>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); margin-bottom: var(--space-4); flex-wrap: wrap;">
            <div>
                <h2 class="section-title">Riwayat Pengajuan Program</h2>
                <p class="section-subtitle">Daftar pengajuan program dan catatan review dari Dinas.</p>
            </div>
            <div class="soft-panel" style="padding: var(--space-3) var(--space-4);">
                <span class="detail-label">Total Pengajuan</span>
                <div class="detail-value" style="font-weight: 800;">{{ $pengajuans->count() }}</div>
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Program</th>
                        <th>Kebutuhan Usaha</th>
                        <th>Catatan Dinas</th>
                        <th style="text-align: right;">Status & Riwayat</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuans as $pengajuan)
                        <tr>
                            <td style="white-space: nowrap;">{{ $pengajuan->created_at->format('d M Y') }}</td>
                            <td style="font-weight: 800; color: var(--color-gray-900);">{{ $pengajuan->program?->name ?? 'Belum tersedia' }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($pengajuan->kebutuhan_usaha ?: 'Belum tersedia', 48) }}</td>
                            <td style="max-width: 18rem;">
                                @if($pengajuan->notes)
                                    {{ $pengajuan->notes }}
                                @else
                                    <span style="font-size: var(--text-xs); color: var(--color-text-muted);">Belum ada catatan</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <x-status-badge :status="$pengajuan->status" />
                                <div style="margin-top: var(--space-2); font-size: var(--text-xs); color: var(--color-text-muted); line-height: 1.5;">
                                    <div>Diajukan: {{ $pengajuan->created_at->format('d M Y') }}</div>
                                    @if($pengajuan->reviewed_at)
                                        <div>{{ $pengajuan->status === 'approved' ? 'Disetujui' : 'Ditolak' }}: {{ $pengajuan->reviewed_at->format('d M Y') }}</div>
                                    @else
                                        <div>Menunggu peninjauan</div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="icon-chip" style="margin: 0 auto var(--space-3);">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line></svg>
                                    </div>
                                    <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Belum ada pengajuan program</h3>
                                    <p style="margin-bottom: var(--space-4);">Riwayat pengajuan akan muncul setelah formulir dikirim.</p>
                                    @if($programsPendanaan->isNotEmpty() && $isVerified)
                                        <button type="button" onclick="openModal()" class="btn btn-primary">Ajukan Program</button>
                                    @elseif($programsPendanaan->isEmpty())
                                        <p style="font-size: var(--text-xs); color: var(--color-text-muted);">Belum ada program aktif saat ini.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>

<div id="modal-pengajuan" class="fixed inset-0 z-50 items-center justify-center p-4 bg-black/50 backdrop-blur-sm" style="display: none;">
    <div class="form-card" style="width: min(100%, 34rem); padding: 0; overflow: hidden;">
        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: var(--space-4); padding: var(--space-5) var(--space-6); border-bottom: 1px solid var(--color-border);">
            <div>
                <h2 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin: 0;">Ajukan Program</h2>
                <p style="font-size: var(--text-sm); color: var(--color-text-muted); margin: 2px 0 0;">Pilih program dan jelaskan kebutuhan usaha Anda.</p>
            </div>
            <button onclick="closeModal()" type="button" style="padding: 0.35rem; border: none; background: transparent; cursor: pointer; color: var(--color-text-muted);">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <form action="{{ route('umkm.pengajuan.store') }}" method="POST" enctype="multipart/form-data" style="padding: var(--space-6);" class="flex flex-col gap-5">
            @csrf
            <input type="hidden" name="jenis" value="pendanaan">

            <div class="form-group">
                <label for="program_id" class="form-label">Program <span style="color: var(--color-danger);">*</span></label>
                <select id="program_id" name="program_id" required class="form-control">
                    <option value="">-- Pilih Program --</option>
                    @foreach($programsPendanaan as $program)
                        <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                            {{ $program->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kebutuhan_usaha" class="form-label">Kebutuhan Usaha <span style="color: var(--color-danger);">*</span></label>
                <textarea id="kebutuhan_usaha" name="kebutuhan_usaha" rows="4" required class="form-control" style="resize: vertical;" placeholder="Jelaskan kebutuhan dan tujuan pengajuan program Anda.">{{ old('kebutuhan_usaha') }}</textarea>
            </div>

            <div class="form-group">
                <label for="dokumen_pendukung" class="form-label">Dokumen Pendukung <span style="font-size: var(--text-xs); font-weight: 400; color: var(--color-text-muted);">(Opsional)</span></label>
                <label for="dokumen_pendukung" class="soft-panel" style="align-items: center; justify-content: center; min-height: 6.5rem; cursor: pointer; border-style: dashed; text-align: center;">
                    <span style="font-size: var(--text-sm); color: var(--color-gray-900); font-weight: 700;">Klik untuk unggah dokumen</span>
                    <span style="font-size: var(--text-xs); color: var(--color-text-muted);">PDF, PNG, JPG, JPEG (maks 2MB)</span>
                    <input id="dokumen_pendukung" name="dokumen_pendukung" type="file" style="display: none;" accept=".pdf,.png,.jpg,.jpeg" />
                </label>
            </div>

            <div class="action-group" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                <button type="button" onclick="closeModal()" class="btn btn-secondary">Batal</button>
                <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal-pengajuan').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal-pengajuan').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function () {
    @if(old('program_id'))
        document.getElementById('modal-pengajuan').style.display = 'flex';
    @endif
});
</script>
@endsection
