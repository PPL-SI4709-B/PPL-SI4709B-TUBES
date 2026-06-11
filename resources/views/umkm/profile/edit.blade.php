@extends('layouts.app')

@section('title', 'Edit Profil Usaha - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="profile" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.profile.show') }}" style="color: var(--color-text-muted);">Profil</a>
        <span style="margin: 0 0.5rem;">&rsaquo;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Edit</span>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none; font-weight: 500;">Pemilik Usaha</div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="flex flex-col gap-6" style="max-width: 54rem; margin: 0 auto;">
    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <div class="page-kicker">Form Profil</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Edit Profil Usaha</h1>
            <p class="page-subtitle">Lengkapi data usaha agar proses verifikasi dan pengajuan berjalan lancar.</p>
        </div>
    </div>

    @if($errors->any())
        <div dusk="validation-errors" class="alert alert-danger">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="form-card">
        <form action="{{ route('umkm.profile.update') }}" method="POST" enctype="multipart/form-data" dusk="profile-edit-form" class="flex flex-col gap-5">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="logo" class="form-label">Logo Usaha <span style="font-weight: 400; color: var(--color-text-muted);">(PNG/JPG, maks 2MB)</span></label>
                @if($profile?->logo)
                    <img src="{{ Storage::url($profile->logo) }}" alt="Logo" style="width: 4rem; height: 4rem; object-fit: cover; border-radius: var(--radius-lg); border: 1px solid var(--color-border);">
                @endif
                <input id="logo" type="file" name="logo" accept=".png,.jpg,.jpeg,.webp" class="form-control" dusk="profile-logo">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="business_name" class="form-label">Nama Usaha <span style="color: var(--color-danger);">*</span></label>
                    <input id="business_name" type="text" name="business_name" value="{{ old('business_name', $profile?->business_name) }}" required class="form-control" dusk="profile-business-name">
                </div>
                <div class="form-group">
                    <label for="phone" class="form-label">Nomor Telepon</label>
                    <input id="phone" type="text" name="phone" value="{{ old('phone', $profile?->phone) }}" class="form-control" placeholder="+62..." dusk="profile-phone">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="nib" class="form-label">NIB</label>
                    <input id="nib" type="text" name="nib" value="{{ old('nib', $profile?->nib) }}" class="form-control" dusk="profile-nib">
                </div>
                <div class="form-group">
                    <label for="category_id" class="form-label">Kategori Usaha <span style="color: var(--color-danger);">*</span></label>
                    <select id="category_id" name="category_id" required class="form-control" dusk="profile-category-select">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $profile?->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label for="region_id" class="form-label">Wilayah <span style="color: var(--color-danger);">*</span></label>
                    <select id="region_id" name="region_id" required class="form-control" dusk="profile-region-select">
                        <option value="">-- Pilih Wilayah --</option>
                        @foreach($regions as $reg)
                            <option value="{{ $reg->id }}" {{ old('region_id', $profile?->region_id) == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="scale_id" class="form-label">Skala Usaha <span style="color: var(--color-danger);">*</span></label>
                    <select id="scale_id" name="scale_id" required class="form-control" dusk="profile-scale-select">
                        <option value="">-- Pilih Skala --</option>
                        @foreach($scales as $scale)
                            <option value="{{ $scale->id }}" {{ old('scale_id', $profile?->scale_id) == $scale->id ? 'selected' : '' }}>{{ $scale->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="business_address" class="form-label">Alamat Usaha <span style="color: var(--color-danger);">*</span></label>
                <textarea id="business_address" name="business_address" rows="4" required class="form-control" style="resize: vertical;" dusk="profile-business-address">{{ old('business_address', $profile?->business_address) }}</textarea>
            </div>

            <div class="action-group" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                <a href="{{ route('umkm.profile.show') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" dusk="profile-submit">Simpan Profil</button>
            </div>
        </form>
    </section>
</div>
@endsection
