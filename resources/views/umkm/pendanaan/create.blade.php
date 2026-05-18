@extends('layouts.app')

@section('title', 'Ajukan Pendanaan - Portal UMKM')

@section('sidebar')
<x-umkm-sidebar active="pendanaan" />
@endsection

@section('header')
<header class="main-header" style="height: 4rem;">
    <div class="page-title" style="color: var(--color-text-muted); font-size: 0.875rem; font-weight: 500;">
        <a href="{{ route('umkm.pendanaan.index') }}" style="color: var(--color-text-muted); text-decoration: none;">Pengajuan Pendanaan</a>
        <span style="margin: 0 0.5rem;">&#8250;</span>
        <span style="color: var(--color-primary); font-weight: 700;">Formulir Pengajuan</span>
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
<div style="max-width: 42rem; margin: 0 auto;">

    @if($errors->any())
        <div style="background-color: #fef2f2; color: #dc2626; padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); border-left: 4px solid #dc2626; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1rem;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card p-0 overflow-hidden">
        <div style="padding: 1.5rem; border-bottom: 1px solid var(--color-border);">
            <h1 class="font-bold text-gray-900" style="font-size: 1.125rem;">Formulir Pengajuan Pendanaan</h1>
            <p class="text-sm text-gray-500 mt-1">Isi formulir berikut untuk mengajukan permohonan pendanaan usaha.</p>
        </div>

        <form action="{{ route('umkm.pendanaan.store') }}" method="POST" enctype="multipart/form-data" style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem;">
            @csrf

            @if($sumberPendanaans->isEmpty())
                <div style="background-color: #fefce8; border-left: 4px solid #f59e0b; padding: 1rem 1.25rem; border-radius: var(--radius-md); font-size: 0.875rem; color: #92400e;">
                    <strong>Belum ada skema pendanaan aktif.</strong> Silakan hubungi Dinas untuk informasi lebih lanjut.
                </div>
            @endif

            <div>
                <label for="sumber_pendanaan_id" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.375rem;">
                    Sumber Pendanaan <span style="color: #dc2626;">*</span>
                </label>
                <select id="sumber_pendanaan_id" name="sumber_pendanaan_id" required
                    style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid {{ $errors->has('sumber_pendanaan_id') ? '#dc2626' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: 0.875rem; outline: none; font-family: inherit; background-color: white;">
                    <option value="">&mdash; Pilih Sumber Pendanaan &mdash;</option>
                    @foreach($sumberPendanaans as $sumber)
                        <option value="{{ $sumber->id }}" {{ old('sumber_pendanaan_id') == $sumber->id ? 'selected' : '' }}
                            data-batas="{{ $sumber->batas_maksimal }}">
                            {{ $sumber->nama_program }} - {{ $sumber->mitra_penyalur }} (Maks. Rp {{ number_format($sumber->batas_maksimal, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
                @error('sumber_pendanaan_id')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jumlah_pengajuan" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.375rem;">
                    Jumlah Pengajuan (Rp) <span style="color: #dc2626;">*</span>
                </label>
                <input id="jumlah_pengajuan" type="number" name="jumlah_pengajuan" value="{{ old('jumlah_pengajuan') }}" placeholder="Minimal 100.000" min="100000" step="1000" required
                    style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid {{ $errors->has('jumlah_pengajuan') ? '#dc2626' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: 0.875rem; outline: none; font-family: inherit;">
                @error('jumlah_pengajuan')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tujuan_pendanaan" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.375rem;">
                    Tujuan Pendanaan <span style="color: #dc2626;">*</span>
                </label>
                <input id="tujuan_pendanaan" type="text" name="tujuan_pendanaan" value="{{ old('tujuan_pendanaan') }}" placeholder="Contoh: Pengembangan kapasitas produksi" required
                    style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid {{ $errors->has('tujuan_pendanaan') ? '#dc2626' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: 0.875rem; outline: none; font-family: inherit;">
                @error('tujuan_pendanaan')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="deskripsi_kebutuhan" style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.375rem;">
                    Deskripsi Kebutuhan <span style="color: #dc2626;">*</span>
                </label>
                <textarea id="deskripsi_kebutuhan" name="deskripsi_kebutuhan" rows="5" required placeholder="Jelaskan secara detail kebutuhan pendanaan usaha Anda... (minimal 30 karakter)"
                    style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid {{ $errors->has('deskripsi_kebutuhan') ? '#dc2626' : 'var(--color-border)' }}; border-radius: var(--radius-md); font-size: 0.875rem; outline: none; font-family: inherit; resize: vertical;">{{ old('deskripsi_kebutuhan') }}</textarea>
                @error('deskripsi_kebutuhan')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label style="display: block; font-size: 0.875rem; font-weight: 600; color: var(--color-text); margin-bottom: 0.375rem;">
                    Dokumen Pendukung <span style="font-size: 0.75rem; font-weight: 400; color: var(--color-text-muted);">(Opsional)</span>
                </label>
                <label for="dokumen_pendukung" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 6rem; border: 2px dashed var(--color-border); border-radius: var(--radius-md); cursor: pointer; background-color: #f9fafb;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="margin-bottom: 0.25rem;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                    <p style="font-size: 0.75rem; color: #6b7280;"><span style="font-weight: 600;">Klik untuk unggah</span> — PDF, PNG, JPG, JPEG (Maks 2MB)</p>
                    <input id="dokumen_pendukung" name="dokumen_pendukung" type="file" style="display: none;" accept=".pdf,.png,.jpg,.jpeg" />
                </label>
                <p id="file-name-display" style="font-size: 0.75rem; color: var(--color-text-muted); margin-top: 0.25rem;"></p>
                @error('dokumen_pendukung')
                    <p style="color: #dc2626; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                @enderror
            </div>

            <div style="display: flex; gap: 0.75rem; justify-content: flex-end; padding-top: 0.5rem; border-top: 1px solid var(--color-border);">
                <a href="{{ route('umkm.pendanaan.index') }}" class="btn" style="background-color: var(--color-border); color: var(--color-text); border-radius: var(--radius-md);">Batal</a>
                <button type="submit" class="btn" {{ $sumberPendanaans->isEmpty() ? 'disabled' : '' }} style="background-color: #16a34a; color: white; border-radius: var(--radius-md); {{ $sumberPendanaans->isEmpty() ? 'opacity: 0.6; cursor: not-allowed;' : '' }}">Kirim Pengajuan</button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('dokumen_pendukung').addEventListener('change', function() {
    var name = this.files.length > 0 ? 'File dipilih: ' + this.files[0].name : '';
    document.getElementById('file-name-display').textContent = name;
});
</script>
@endsection
