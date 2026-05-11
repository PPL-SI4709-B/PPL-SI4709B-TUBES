@extends('layouts.app')

@section('sidebar')
<x-umkm-sidebar active="profile" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.profile.show') }}" style="color: var(--color-text-muted);">Profil</a>
        <span style="margin: 0 0.5rem;">&#8250;</span>
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
<div style="max-width: 48rem; margin: 0 auto;">
    <div class="card" style="padding: var(--space-6);">
        <div style="font-size: var(--text-lg); font-weight: 700; color: var(--color-gray-900); margin-bottom: var(--space-6);">Edit Profil Usaha</div>

        @if($errors->any())
            <div style="background-color: #fef2f2; color: var(--color-danger); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); margin-bottom: var(--space-4); border-left: 4px solid var(--color-danger);">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('umkm.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="flex flex-col gap-4">
                <div>
                    <label style="font-size: var(--text-sm); font-weight: 500; color: var(--color-gray-900); display: block; margin-bottom: var(--space-1);">Nama Usaha <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="business_name" value="{{ old('business_name', $profile?->business_name) }}" required style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm);">
                </div>

                <div>
                    <label style="font-size: var(--text-sm); font-weight: 500; color: var(--color-gray-900); display: block; margin-bottom: var(--space-1);">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $profile?->phone) }}" style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm);" placeholder="+62...">
                </div>

                <div>
                    <label style="font-size: var(--text-sm); font-weight: 500; color: var(--color-gray-900); display: block; margin-bottom: var(--space-1);">NIB</label>
                    <input type="text" name="nib" value="{{ old('nib', $profile?->nib) }}" style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm);">
                </div>

                <div>
                    <label style="font-size: var(--text-sm); font-weight: 500; color: var(--color-gray-900); display: block; margin-bottom: var(--space-1);">Kategori Usaha <span style="color: var(--color-danger);">*</span></label>
                    <select name="category_id" required style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm);">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $profile?->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="font-size: var(--text-sm); font-weight: 500; color: var(--color-gray-900); display: block; margin-bottom: var(--space-1);">Wilayah <span style="color: var(--color-danger);">*</span></label>
                    <select name="region_id" required style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm);">
                        <option value="">-- Pilih Wilayah --</option>
                        @foreach($regions as $reg)
                            <option value="{{ $reg->id }}" {{ old('region_id', $profile?->region_id) == $reg->id ? 'selected' : '' }}>{{ $reg->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="font-size: var(--text-sm); font-weight: 500; color: var(--color-gray-900); display: block; margin-bottom: var(--space-1);">Skala Usaha <span style="color: var(--color-danger);">*</span></label>
                    <select name="scale_id" required style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm);">
                        <option value="">-- Pilih Skala --</option>
                        @foreach($scales as $scale)
                            <option value="{{ $scale->id }}" {{ old('scale_id', $profile?->scale_id) == $scale->id ? 'selected' : '' }}>{{ $scale->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label style="font-size: var(--text-sm); font-weight: 500; color: var(--color-gray-900); display: block; margin-bottom: var(--space-1);">Alamat Usaha <span style="color: var(--color-danger);">*</span></label>
                    <textarea name="business_address" rows="3" required style="width: 100%; padding: var(--space-2) var(--space-3); border: 1px solid var(--color-border); border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical;">{{ old('business_address', $profile?->business_address) }}</textarea>
                </div>
            </div>

            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('umkm.profile.show') }}" class="btn" style="background-color: var(--color-border); color: var(--color-primary);">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
