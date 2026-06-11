@extends('layouts.app')

@section('title', 'Profil Usaha - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="profile" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        Profil Usaha
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
@php
    $statusClass = match($user->profile_status) {
        'verified' => 'badge-success',
        'rejected' => 'badge-danger',
        default => 'badge-warning',
    };
    $statusLabel = match($user->profile_status) {
        'verified' => 'Terverifikasi',
        'rejected' => 'Ditolak',
        default => 'Menunggu Verifikasi',
    };
@endphp

<div class="flex flex-col gap-6" style="max-width: 56rem; margin: 0 auto;" dusk="profile-show">
    @if(session('success'))
        <div dusk="flash-success" class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="page-header">
        <div>
            <div class="page-kicker">Profil UMKM</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Profil Usaha</h1>
            <p class="page-subtitle">Informasi identitas pemilik dan data usaha yang digunakan untuk verifikasi.</p>
        </div>
        <a href="{{ route('umkm.profile.edit') }}" class="btn btn-primary" dusk="profile-edit-link">Edit Profil</a>
    </div>

    <section class="content-card">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); flex-wrap: wrap;">
            <div>
                <h2 class="section-title">Identitas Pemilik</h2>
                <p class="section-subtitle">Data akun dan status verifikasi profil usaha.</p>
            </div>
            <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
        </div>

        <div class="detail-grid" style="margin-top: var(--space-5);">
            <div class="detail-section">
                <div class="detail-label">Nama Pemilik</div>
                <div class="detail-value">{{ $user->name }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Email</div>
                <div class="detail-value">{{ $user->email }}</div>
            </div>
            <div class="detail-section">
                <div class="detail-label">Status Verifikasi</div>
                <div>
                    <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                </div>
                @if($user->verified_at)
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted);">Diproses pada {{ $user->verified_at->format('d M Y, H:i') }}</div>
                @endif
            </div>
            @if($user->profile_status === 'rejected' && $user->verification_note)
                <div class="detail-section">
                    <div class="detail-label">Catatan Verifikasi</div>
                    <div class="soft-panel" style="color: var(--color-danger);">{{ $user->verification_note }}</div>
                </div>
            @endif
        </div>
    </section>

    @if($profile)
        <section class="content-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: var(--space-4); margin-bottom: var(--space-5); flex-wrap: wrap;">
                <div>
                    <h2 class="section-title">Data Usaha</h2>
                    <p class="section-subtitle">Informasi usaha yang akan ditinjau oleh petugas Dinas.</p>
                </div>
                @if($profile->logo)
                    <img src="{{ Storage::url($profile->logo) }}" alt="Logo {{ $profile->business_name }}" style="width: 4.5rem; height: 4.5rem; object-fit: cover; border-radius: var(--radius-lg); border: 1px solid var(--color-border);">
                @endif
            </div>

            <div class="detail-grid">
                <div class="detail-section">
                    <div class="detail-label">Nama Usaha</div>
                    <div class="detail-value">{{ $profile->business_name }}</div>
                </div>
                <div class="detail-section">
                    <div class="detail-label">Telepon</div>
                    <div class="detail-value">{{ $profile->phone ?? 'Belum tersedia' }}</div>
                </div>
                <div class="detail-section">
                    <div class="detail-label">NIB</div>
                    <div class="detail-value">{{ $profile->nib ?? 'Belum tersedia' }}</div>
                </div>
                <div class="detail-section">
                    <div class="detail-label">Kategori Usaha</div>
                    <div class="detail-value">{{ $profile->category?->name ?? 'Belum tersedia' }}</div>
                </div>
                <div class="detail-section">
                    <div class="detail-label">Wilayah</div>
                    <div class="detail-value">{{ $profile->region?->name ?? 'Belum tersedia' }}</div>
                </div>
                <div class="detail-section">
                    <div class="detail-label">Skala Usaha</div>
                    <div class="detail-value">{{ $profile->scale?->name ?? 'Belum tersedia' }}</div>
                </div>
            </div>
            <div class="detail-section" style="margin-top: var(--space-5);">
                <div class="detail-label">Alamat Usaha</div>
                <div class="soft-panel">{{ $profile->business_address ?: 'Belum tersedia' }}</div>
            </div>
        </section>
    @else
        <section class="content-card">
            <div class="empty-state">
                <div class="icon-chip" style="margin: 0 auto var(--space-3);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <h3 style="font-size: var(--text-base); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-1);">Data usaha belum diisi</h3>
                <p style="margin-bottom: var(--space-4);">Lengkapi profil usaha agar dapat mengajukan program dan pendanaan.</p>
                <a href="{{ route('umkm.profile.edit') }}" class="btn btn-primary">Lengkapi Profil</a>
            </div>
        </section>
    @endif
</div>
@endsection
