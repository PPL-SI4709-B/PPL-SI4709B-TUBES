@extends('layouts.app')

@section('title', 'Ajukan Pendanaan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pendanaan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.pendanaan.index') }}" style="color: var(--color-text-muted); text-decoration: none;">Pengajuan Pendanaan</a>
        <span style="margin: 0 0.5rem;">&rsaquo;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Formulir Pengajuan</span>
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
<div class="flex flex-col gap-6" style="max-width: 46rem; margin: 0 auto;">
    <div class="page-header" style="margin-bottom: 0;">
        <div>
            <div class="page-kicker">Form UMKM</div>
            <h1 style="font-size: 1.5rem; font-weight: 800; color: var(--color-gray-900); margin-top: var(--space-1);">Formulir Pengajuan Pendanaan</h1>
            <p class="page-subtitle">Isi kebutuhan pendanaan secara jelas agar proses review Dinas lebih mudah.</p>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="form-card">
        <form action="{{ route('umkm.pendanaan.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
            @csrf

            @if($sumberPendanaans->isEmpty())
                <div class="alert alert-warning">
                    <strong>Belum ada skema pendanaan aktif.</strong> Silakan hubungi Dinas untuk informasi lebih lanjut.
                </div>
            @endif

            <div class="form-group">
                <label for="sumber_pendanaan_id" class="form-label">
                    Sumber Pendanaan <span style="color: var(--color-danger);">*</span>
                </label>
                <select id="sumber_pendanaan_id" name="sumber_pendanaan_id" required class="form-control" style="border-color: {{ $errors->has('sumber_pendanaan_id') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                    <option value="">-- Pilih Sumber Pendanaan --</option>
                    @foreach($sumberPendanaans as $sumber)
                        <option value="{{ $sumber->id }}" {{ old('sumber_pendanaan_id') == $sumber->id ? 'selected' : '' }} data-batas="{{ $sumber->batas_maksimal }}">
                            {{ $sumber->nama_program }} - {{ $sumber->mitra_penyalur }} (Maks. Rp {{ number_format($sumber->batas_maksimal, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                @error('sumber_pendanaan_id')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="jumlah_pengajuan" class="form-label">
                    Jumlah Pengajuan (Rp) <span style="color: var(--color-danger);">*</span>
                </label>
                <input id="jumlah_pengajuan" type="number" name="jumlah_pengajuan" value="{{ old('jumlah_pengajuan') }}" placeholder="Minimal 100.000" min="100000" step="1000" required class="form-control" style="border-color: {{ $errors->has('jumlah_pengajuan') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                @error('jumlah_pengajuan')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="tujuan_pendanaan" class="form-label">
                    Tujuan Pendanaan <span style="color: var(--color-danger);">*</span>
                </label>
                <input id="tujuan_pendanaan" type="text" name="tujuan_pendanaan" value="{{ old('tujuan_pendanaan') }}" placeholder="Contoh: Pengembangan kapasitas produksi" required class="form-control" style="border-color: {{ $errors->has('tujuan_pendanaan') ? 'var(--color-danger)' : 'var(--color-border)' }};">
                @error('tujuan_pendanaan')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="deskripsi_kebutuhan" class="form-label">
                    Deskripsi Kebutuhan <span style="color: var(--color-danger);">*</span>
                </label>
                <textarea id="deskripsi_kebutuhan" name="deskripsi_kebutuhan" rows="5" required placeholder="Jelaskan kebutuhan pendanaan usaha Anda secara ringkas dan jelas." class="form-control" style="resize: vertical; border-color: {{ $errors->has('deskripsi_kebutuhan') ? 'var(--color-danger)' : 'var(--color-border)' }};">{{ old('deskripsi_kebutuhan') }}</textarea>
                @error('deskripsi_kebutuhan')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="dokumen_pendukung" class="form-label">
                    Dokumen Pendukung <span style="font-size: var(--text-xs); font-weight: 400; color: var(--color-text-muted);">(Opsional)</span>
                </label>
                <label for="dokumen_pendukung" class="soft-panel" style="align-items: center; justify-content: center; min-height: 7rem; cursor: pointer; border-style: dashed; text-align: center;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" style="margin-bottom: var(--space-2);"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    <span style="font-size: var(--text-sm); color: var(--color-gray-900); font-weight: 700;">Klik untuk unggah dokumen</span>
                    <span style="font-size: var(--text-xs); color: var(--color-text-muted);">PDF, PNG, JPG, JPEG (maks 2MB)</span>
                    <input id="dokumen_pendukung" name="dokumen_pendukung" type="file" style="display: none;" accept=".pdf,.png,.jpg,.jpeg" />
                </label>
                <p id="file-name-display" style="font-size: var(--text-xs); color: var(--color-text-muted); margin: 0;"></p>
                @error('dokumen_pendukung')
                    <p style="color: var(--color-danger); font-size: var(--text-xs); margin: 0;">{{ $message }}</p>
                @enderror
            </div>

            <div class="action-group" style="padding-top: var(--space-4); border-top: 1px solid var(--color-border);">
                <a href="{{ route('umkm.pendanaan.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary" {{ $sumberPendanaans->isEmpty() ? 'disabled' : '' }} style="{{ $sumberPendanaans->isEmpty() ? 'opacity: 0.6; cursor: not-allowed;' : '' }}">Kirim Pengajuan</button>
            </div>
        </form>
    </section>
</div>

<script>
document.getElementById('dokumen_pendukung').addEventListener('change', function() {
    var name = this.files.length > 0 ? 'File dipilih: ' + this.files[0].name : '';
    document.getElementById('file-name-display').textContent = name;
});
</script>
@endsection
