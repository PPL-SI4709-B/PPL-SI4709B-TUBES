@extends('layouts.app')

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
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ef4444&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 48rem; margin: 0 auto;" dusk="profile-show">

    @if(session('success'))
        <div dusk="flash-success" style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500; border-left: 4px solid var(--color-success);">
            {{ session('success') }}
        </div>
    @endif

    <div class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-start" style="margin-bottom: var(--space-6);">
            <div>
                <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900);">Profil Usaha</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">Informasi usaha terdaftar Anda</div>
            </div>
            <a href="{{ route('umkm.profile.edit') }}" class="btn btn-primary" style="font-size: var(--text-sm);" dusk="profile-edit-link">
                Edit Profil
            </a>
        </div>

        <div class="flex flex-col gap-4">
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Nama Pemilik</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $user->name }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Email</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $user->email }}</div>
            </div>
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Status Verifikasi</div>
                <div style="margin-top: 4px;">
                    @php
                        $statusColors = match($user->profile_status) {
                            'verified' => ['bg' => 'var(--color-success-bg)', 'text' => 'var(--color-success)'],
                            'rejected' => ['bg' => '#fef2f2', 'text' => 'var(--color-danger)'],
                            default    => ['bg' => '#fffbeb', 'text' => '#b45309'],
                        };
                        $statusLabel = match($user->profile_status) {
                            'verified' => 'Terverifikasi',
                            'rejected' => 'Ditolak',
                            default    => 'Menunggu Verifikasi',
                        };
                    @endphp
                    <span class="badge" style="background-color: {{ $statusColors['bg'] }}; color: {{ $statusColors['text'] }};">{{ $statusLabel }}</span>
                </div>
                {{-- PBI-19: riwayat verifikasi --}}
                @if($user->verified_at)
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); margin-top: 4px;">Diproses pada {{ $user->verified_at->format('d M Y, H:i') }}</div>
                @endif
                @if($user->profile_status === 'rejected' && $user->verification_note)
                    <div style="font-size: var(--text-sm); color: var(--color-danger); margin-top: 4px; padding: var(--space-2) var(--space-3); background: #fef2f2; border-radius: var(--radius-md);">Alasan: {{ $user->verification_note }}</div>
                @endif
            </div>
        </div>
    </div>

    @if($profile)
        <div class="card" style="padding: var(--space-6);">
            <div style="font-size: var(--text-base); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-4);">Data Usaha</div>
            <div class="flex flex-col gap-4">
                @if($profile->logo)
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Logo Usaha</div>
                    <img src="{{ Storage::url($profile->logo) }}" alt="Logo {{ $profile->business_name }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius-md); border: 1px solid var(--color-border); margin-top: 4px;">
                </div>
                @endif
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Nama Usaha</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile->business_name }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Telepon</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile->phone ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">NIB</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile->nib ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Kategori Usaha</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile->category?->name ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Wilayah</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile->region?->name ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Skala Usaha</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile->scale?->name ?? '-' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em;">Alamat Usaha</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile->business_address }}</div>
                </div>
            </div>
        </div>
    @else
        <div class="card" style="padding: var(--space-8); text-align: center;">
            <div style="color: var(--color-text-muted); margin-bottom: var(--space-2);">
                <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="display: inline-block;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
            <div style="font-size: var(--text-base); font-weight: 600; color: var(--color-gray-900); margin-bottom: var(--space-1);">Data usaha belum diisi</div>
            <p style="font-size: var(--text-sm); color: var(--color-text-muted); margin-bottom: var(--space-4);">Lengkapi profil usaha Anda agar dapat mengajukan program.</p>
            <a href="{{ route('umkm.profile.edit') }}" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem;">
                Lengkapi Profil
            </a>
        </div>
    @endif

</div>
@endsection
