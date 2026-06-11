@extends('layouts.app')

@section('title', isset($laporan) ? 'Edit Laporan Berkala - Portal UMKM' : 'Buat Laporan Berkala - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="laporan-berkala" />
@endsection

@section('header')
<header class="main-header">
    <div>
        <div class="page-title">{{ isset($laporan) ? 'Edit Laporan Berkala' : 'Buat Laporan Berkala' }}</div>
        <div class="page-subtitle">Isi perkembangan usaha Anda untuk periode laporan terpilih.</div>
    </div>
    <div class="user-profile">
        <div class="user-info">
            <div class="user-name">{{ Auth::user()->name }}</div>
            <div class="user-role" style="text-transform: none;">Pemilik Usaha</div>
        </div>
        <div class="user-avatar" style="background-color: transparent;">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=064E3B&color=fff&rounded=true" alt="{{ Auth::user()->name }}" style="border-radius: 50%;">
        </div>
    </div>
</header>
@endsection

@section('content')
@php
    $isEdit = isset($laporan);
    $actionUrl = $isEdit ? route('umkm.laporan_berkala.update', $laporan->id) : route('umkm.laporan_berkala.store');
@endphp

<div class="support-page narrow">
    <div class="secondary-page-header">
        <div>
            <div class="page-kicker">Perkembangan Usaha</div>
            <h1>{{ $isEdit ? 'Edit Laporan Perkembangan Usaha' : 'Form Laporan Perkembangan Usaha' }}</h1>
            <p class="page-subtitle">Lengkapi data laporan kuartal. Anda dapat menyimpannya sebagai draft sebelum dikirim.</p>
        </div>
    </div>

    <section class="form-card">
        <form action="{{ $actionUrl }}" method="POST" class="flex flex-col gap-5">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="form-grid">
                <div class="form-group">
                    <label for="tahun" class="form-label">Tahun Laporan <span style="color: var(--color-danger);">*</span></label>
                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $isEdit ? $laporan->tahun : date('Y')) }}" class="form-control" required>
                    @error('tahun')
                        <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kuartal" class="form-label">Kuartal <span style="color: var(--color-danger);">*</span></label>
                    <select id="kuartal" name="kuartal" class="form-control" required>
                        <option value="Q1" {{ old('kuartal', $isEdit ? $laporan->kuartal : '') == 'Q1' ? 'selected' : '' }}>Q1 (Januari - Maret)</option>
                        <option value="Q2" {{ old('kuartal', $isEdit ? $laporan->kuartal : '') == 'Q2' ? 'selected' : '' }}>Q2 (April - Juni)</option>
                        <option value="Q3" {{ old('kuartal', $isEdit ? $laporan->kuartal : '') == 'Q3' ? 'selected' : '' }}>Q3 (Juli - September)</option>
                        <option value="Q4" {{ old('kuartal', $isEdit ? $laporan->kuartal : '') == 'Q4' ? 'selected' : '' }}>Q4 (Oktober - Desember)</option>
                    </select>
                    @error('kuartal')
                        <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="omzet" class="form-label">Omzet Usaha (Kuartal Ini)</label>
                <div class="flex">
                    <span class="input-prefix">Rp</span>
                    <input type="number" name="omzet" id="omzet" value="{{ old('omzet', $isEdit ? $laporan->omzet : '') }}" class="input-field input-with-prefix" placeholder="0" min="0">
                </div>
                @error('omzet')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_karyawan" class="form-label">Jumlah Karyawan Saat Ini</label>
                <input type="number" name="jumlah_karyawan" id="jumlah_karyawan" value="{{ old('jumlah_karyawan', $isEdit ? $laporan->jumlah_karyawan : '') }}" class="form-control" min="0">
                @error('jumlah_karyawan')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="kendala" class="form-label">Kendala yang Dihadapi (Opsional)</label>
                <textarea id="kendala" name="kendala" rows="3" class="form-control" style="resize: vertical;">{{ old('kendala', $isEdit ? $laporan->kendala : '') }}</textarea>
                @error('kendala')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="strategi_kedepan" class="form-label">Strategi ke Depan (Opsional)</label>
                <textarea id="strategi_kedepan" name="strategi_kedepan" rows="3" class="form-control" style="resize: vertical;">{{ old('strategi_kedepan', $isEdit ? $laporan->strategi_kedepan : '') }}</textarea>
                @error('strategi_kedepan')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="action-group" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                <a href="{{ route('umkm.laporan_berkala.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" name="action" value="draft" class="btn btn-warning">Simpan Draft</button>
                <button type="submit" name="action" value="submit" class="btn btn-primary">Kirim Laporan</button>
            </div>
        </form>
    </section>
</div>
@endsection
