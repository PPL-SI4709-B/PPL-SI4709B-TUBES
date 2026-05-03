@extends('layouts.app')

@section('sidebar')
<aside class="sidebar">
    <div class="sidebar-brand flex items-center gap-3">
        <div style="background: white; border-radius: var(--radius-sm); padding: 0.25rem;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        </div>
        <div>
            <div class="brand-title" style="font-size: 1rem; line-height: 1.1;">PORTAL UMKM</div>
            <div class="brand-subtitle" style="font-size: 0.65rem; color: rgba(255,255,255,0.7);">KABUPATEN BANDUNG</div>
        </div>
    </div>
    <nav class="nav-menu">
        <a href="{{ route('umkm.dashboard') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
            Beranda
        </a>
        <a href="{{ route('umkm.profile.show') }}" class="nav-item active" style="background-color: rgba(255,255,255,0.1); color: white;">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span>
            Profil Usaha
        </a>
        <a href="{{ route('umkm.pengajuan.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg></span>
            Pengajuan Program
        </a>
        <a href="{{ route('umkm.event') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect></svg></span>
            Event &amp; Pelatihan
        </a>
        <a href="{{ route('reports.index') }}" class="nav-item">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Laporan Perkembangan
        </a>
    </nav>
    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
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
