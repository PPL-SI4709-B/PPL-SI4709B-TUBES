@extends('layouts.auth')

@section('content')
<!-- Card Container -->
<div class="card mb-6">

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-xl font-bold text-dark tracking-tight mb-2">Daftar sebagai Pelaku UMKM</h1>
        <p class="text-sm text-muted m-0">Lengkapi data usaha Anda untuk melanjutkan pendaftaran.</p>
    </div>

    <x-stepper current="2" />

    <form action="{{ route('umkm.register.step-2.post') }}" method="POST" class="flex-col gap-5">
        @csrf
        
        <!-- Nama Usaha -->
        <div class="flex-col gap-2">
            <label class="input-label">NAMA USAHA</label>
            <input type="text" name="business_name" class="input-field" value="{{ old('business_name', $registerStep2['business_name'] ?? '') }}" placeholder="Masukkan nama usaha Anda">
        </div>

        <!-- Kategori Usaha -->
        <div class="flex-col gap-2">
            <label class="input-label">KATEGORI USAHA</label>
            <div class="relative">
                <select name="category_id" class="input-field text-muted" style="appearance: none; padding-right: 40px;">
                    <option value="">Pilih Kategori Usaha</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $registerStep2['category_id'] ?? '') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <span class="absolute text-muted" style="right: 12px; top: 12px; pointer-events: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
        </div>

        <!-- Wilayah Usaha -->
        <div class="flex-col gap-2">
            <label class="input-label">WILAYAH USAHA</label>
            <div class="relative">
                <select name="region_id" class="input-field text-muted" style="appearance: none; padding-right: 40px;">
                    <option value="">Pilih Wilayah Usaha</option>
                    @foreach($regions as $region)
                        <option value="{{ $region->id }}" {{ old('region_id', $registerStep2['region_id'] ?? '') == $region->id ? 'selected' : '' }}>
                            {{ $region->name }}
                        </option>
                    @endforeach
                </select>
                <span class="absolute text-muted" style="right: 12px; top: 12px; pointer-events: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
        </div>

        <!-- Alamat Usaha -->
        <div class="flex-col gap-2">
            <label class="input-label">ALAMAT USAHA</label>
            <textarea name="business_address" class="input-field" rows="3" placeholder="Masukkan alamat lengkap usaha Anda" style="resize: vertical;">{{ old('business_address', $registerStep2['business_address'] ?? '') }}</textarea>
        </div>

        <!-- NIB -->
        <div class="flex-col gap-2">
            <label class="input-label">NIB (Opsional)</label>
            <input type="text" name="nib" class="input-field" value="{{ old('nib', $registerStep2['nib'] ?? '') }}" placeholder="Masukkan Nomor Induk Berusaha (jika ada)">
        </div>
        
        <!-- Skala Usaha -->
        <div class="flex-col gap-2 mb-2">
            <label class="input-label">SKALA USAHA</label>
            <div class="relative">
                <select name="scale_id" class="input-field text-muted" style="appearance: none; padding-right: 40px;">
                    <option value="">Pilih Skala Usaha</option>
                    @foreach($scales as $scale)
                        <option value="{{ $scale->id }}" {{ old('scale_id', $registerStep2['scale_id'] ?? '') == $scale->id ? 'selected' : '' }}>
                            {{ $scale->name }}
                        </option>
                    @endforeach
                </select>
                <span class="absolute text-muted" style="right: 12px; top: 12px; pointer-events: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('umkm.register.step-1') }}" class="btn btn-clear text-brand font-semibold inline-flex items-center justify-center">Kembali</a>
            <button type="submit" class="btn btn-brand">
                Lanjut
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </div>

    </form>
</div>

<x-help-banner />
@endsection
