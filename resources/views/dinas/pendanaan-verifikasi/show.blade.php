@extends('layouts.app')

@section('title', 'Detail Verifikasi Pendanaan')

@section('sidebar')
<x-dinas-sidebar active="pendanaan-verifikasi" />
@endsection

@section('header')
<header class="main-header">
    <div class="page-title">Detail Verifikasi Pendanaan</div>
    <div class="flex items-center gap-6">
        <div class="user-profile">
            <div class="user-info">
                <div class="user-name">{{ Auth::user()?->name }}</div>
                <div class="user-role">PETUGAS DINAS</div>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(Auth::user()?->name ?? 'P', 0, 1)) }}
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
@php
    $profile = $pengajuanPendanaan->user?->umkmProfile;
    $sumberPendanaan = $pengajuanPendanaan->sumberPendanaan;
    $statusHelp = match ($pengajuanPendanaan->status) {
        'diajukan' => 'Pengajuan ini masih menunggu keputusan Dinas.',
        'disetujui' => 'Pengajuan ini sudah disetujui secara administratif oleh Dinas.',
        'ditolak' => 'Pengajuan ini sudah ditolak oleh Dinas.',
        default => 'Pengajuan ini sedang berada dalam proses administrasi.',
    };
@endphp

<div class="flex flex-col gap-6" style="max-width: 76rem; margin: 0 auto;">

    @if (session('success'))
        <div style="background-color: var(--color-success-bg); color: var(--color-success); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="background-color: #fef2f2; color: var(--color-danger); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); font-weight: 500;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background-color: #fef2f2; color: var(--color-danger); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm);">
            {{ $errors->first() }}
        </div>
    @endif

    <div>
        <a href="{{ route('dinas.pendanaan-verifikasi.index') }}" style="font-size: var(--text-sm); color: var(--color-secondary); font-weight: 600;">&larr; Kembali ke Daftar Verifikasi</a>
    </div>

    <section class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-start" style="gap: var(--space-4); flex-wrap: wrap;">
            <div>
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: var(--space-2);">Ringkasan Pengajuan</div>
                <div style="font-size: 1.35rem; font-weight: 800; color: var(--color-gray-900); line-height: 1.25;">{{ $pengajuanPendanaan->tujuan_pendanaan }}</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: var(--space-2);">Keputusan Dinas bersifat administratif sebagai dasar rekomendasi pendanaan.</div>
            </div>
            <div style="min-width: 16rem; border: 1px solid var(--color-border); border-radius: var(--radius-lg); padding: var(--space-4); background: #f8fafc;">
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: var(--space-2);">Status Saat Ini</div>
                <x-pendanaan-status-badge :status="$pengajuanPendanaan->status" />
                <div style="font-size: var(--text-sm); color: var(--color-text-main); margin-top: var(--space-3); line-height: 1.5;">{{ $statusHelp }}</div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(13rem, 100%), 1fr)); gap: var(--space-4); margin-top: var(--space-6);">
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4);">
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Jumlah Pengajuan</div>
                <div style="font-size: 1rem; color: var(--color-gray-900); font-weight: 800; margin-top: var(--space-2);">Rp {{ number_format($pengajuanPendanaan->jumlah_pengajuan, 0, ',', '.') }}</div>
            </div>
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4);">
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Sumber Pendanaan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); font-weight: 700; margin-top: var(--space-2);">{{ $sumberPendanaan?->nama_program ?? 'Belum tersedia' }}</div>
            </div>
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4);">
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Pengajuan</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); font-weight: 700; margin-top: var(--space-2);">{{ ($pengajuanPendanaan->submitted_at ?? $pengajuanPendanaan->created_at)->format('d M Y, H:i') }}</div>
            </div>
        </div>
    </section>

    @if ($pengajuanPendanaan->status !== 'diajukan')
        <div style="background-color: #f8fafc; color: var(--color-text-main); padding: var(--space-4); border-radius: var(--radius-md); font-size: var(--text-sm); border: 1px solid var(--color-border);">
            <strong style="color: var(--color-gray-900);">Pengajuan ini sudah diproses</strong>
            <div style="margin-top: var(--space-1);">Pengajuan ini sudah diproses dan tidak dapat diubah kembali.</div>
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(24rem, 100%), 1fr)); gap: var(--space-6); align-items: start;">
        <section class="card" style="padding: var(--space-6);">
            <div style="font-size: var(--text-lg); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-5);">Data UMKM</div>
            <div class="flex flex-col gap-4">
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Nama User</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px; font-weight: 600;">{{ $pengajuanPendanaan->user?->name ?? 'Belum tersedia' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Email</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $pengajuanPendanaan->user?->email ?? 'Belum tersedia' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Nama Usaha</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile?->business_name ?? 'Belum tersedia' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">NIB</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile?->nib ?? 'Belum tersedia' }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Alamat</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px; line-height: 1.6;">{{ $profile?->business_address ?? 'Belum tersedia' }}</div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(8rem, 100%), 1fr)); gap: var(--space-3);">
                    <div style="background: #f8fafc; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-3);">
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700;">Kategori</div>
                        <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile?->category?->name ?? 'Belum tersedia' }}</div>
                    </div>
                    <div style="background: #f8fafc; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-3);">
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700;">Wilayah</div>
                        <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile?->region?->name ?? 'Belum tersedia' }}</div>
                    </div>
                    <div style="background: #f8fafc; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-3);">
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700;">Skala</div>
                        <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $profile?->scale?->name ?? 'Belum tersedia' }}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="card" style="padding: var(--space-6);">
            <div style="font-size: var(--text-lg); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-5);">Detail Pendanaan</div>
            <div class="flex flex-col gap-4">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(12rem, 100%), 1fr)); gap: var(--space-4);">
                    <div>
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Mitra Penyalur</div>
                        <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">{{ $sumberPendanaan?->mitra_penyalur ?? 'Belum tersedia' }}</div>
                    </div>
                    <div>
                        <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Batas Maksimal</div>
                        <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 2px;">
                            @if ($sumberPendanaan)
                                Rp {{ number_format($sumberPendanaan->batas_maksimal, 0, ',', '.') }}
                            @else
                                Belum tersedia
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Tujuan Pendanaan</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50); border-radius: var(--radius-md); border: 1px solid var(--color-border);">{{ $pengajuanPendanaan->tujuan_pendanaan }}</div>
                </div>
                <div>
                    <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Deskripsi Kebutuhan</div>
                    <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: 4px; padding: var(--space-3); background: var(--color-gray-50); border-radius: var(--radius-md); border: 1px solid var(--color-border); white-space: pre-line; line-height: 1.6;">{{ $pengajuanPendanaan->deskripsi_kebutuhan }}</div>
                </div>
            </div>
        </section>
    </div>

    <section class="card" style="padding: var(--space-6);">
        <div class="flex justify-between items-start" style="gap: var(--space-4); flex-wrap: wrap;">
            <div>
                <div style="font-size: var(--text-lg); font-weight: 800; color: var(--color-gray-900);">Dokumen Pendukung</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">Dokumen dari UMKM untuk bahan pemeriksaan administrasi.</div>
            </div>
            @if ($pengajuanPendanaan->dokumen_pendukung)
                <a href="{{ Storage::url($pengajuanPendanaan->dokumen_pendukung) }}" target="_blank" class="btn btn-primary">Lihat Dokumen</a>
            @endif
        </div>
        @unless ($pengajuanPendanaan->dokumen_pendukung)
            <div style="margin-top: var(--space-4); background: #f8fafc; border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4); font-size: var(--text-sm); color: var(--color-text-muted);">Belum ada dokumen pendukung yang dilampirkan.</div>
        @endunless
    </section>

    <section class="card" style="padding: var(--space-6);">
        <div style="font-size: var(--text-lg); font-weight: 800; color: var(--color-gray-900); margin-bottom: var(--space-5);">Review Dinas</div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(16rem, 100%), 1fr)); gap: var(--space-4);">
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4); background: #f8fafc;">
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Catatan Petugas</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: var(--space-2); white-space: pre-line; line-height: 1.6;">{{ $pengajuanPendanaan->catatan ?: 'Belum ada catatan' }}</div>
            </div>
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4); background: #f8fafc;">
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Direview Oleh</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: var(--space-2); font-weight: 600;">{{ $pengajuanPendanaan->reviewer?->name ?? 'Belum direview' }}</div>
            </div>
            <div style="border: 1px solid var(--color-border); border-radius: var(--radius-md); padding: var(--space-4); background: #f8fafc;">
                <div style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em;">Tanggal Review</div>
                <div style="font-size: var(--text-sm); color: var(--color-gray-900); margin-top: var(--space-2); font-weight: 600;">{{ $pengajuanPendanaan->reviewed_at ? $pengajuanPendanaan->reviewed_at->format('d M Y, H:i') : 'Belum tersedia' }}</div>
            </div>
        </div>
    </section>

    @if ($pengajuanPendanaan->status === 'diajukan')
        <section class="card" style="padding: var(--space-6); border: 1px solid #bfdbfe;">
            <div style="margin-bottom: var(--space-5);">
                <div style="font-size: var(--text-lg); font-weight: 800; color: var(--color-gray-900);">Form Keputusan</div>
                <div style="font-size: var(--text-sm); color: var(--color-text-muted); margin-top: 2px;">Berikan keputusan administratif terhadap pengajuan pendanaan ini.</div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(20rem, 100%), 1fr)); gap: var(--space-5);">
                <form action="{{ route('dinas.pendanaan-verifikasi.approve', $pengajuanPendanaan) }}" method="POST" class="flex flex-col gap-4" style="border: 1px solid #bbf7d0; border-radius: var(--radius-lg); padding: var(--space-5); background: #f0fdf4;">
                        @csrf
                        @method('PUT')
                        <div>
                            <div style="font-size: var(--text-base); font-weight: 800; color: #166534;">Setujui Pengajuan</div>
                            <div style="font-size: var(--text-sm); color: #166534; margin-top: var(--space-1);">Pengajuan akan ditandai sebagai disetujui oleh Dinas.</div>
                        </div>
                        <div>
                            <label for="catatan-approve" style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: var(--space-2);">Catatan Petugas (opsional)</label>
                            <textarea id="catatan-approve" name="catatan" rows="4" style="width: 100%; padding: var(--space-3); border: 1px solid #86efac; border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical; background: white;" placeholder="Tambahkan catatan persetujuan bila diperlukan.">{{ old('catatan') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success" style="width: 100%;" onclick="return confirm('Setujui pengajuan pendanaan ini?')">Setujui Pengajuan</button>
                </form>

                <form action="{{ route('dinas.pendanaan-verifikasi.reject', $pengajuanPendanaan) }}" method="POST" class="flex flex-col gap-4" style="border: 1px solid #fecaca; border-radius: var(--radius-lg); padding: var(--space-5); background: #fef2f2;">
                        @csrf
                        @method('PUT')
                        <div>
                            <div style="font-size: var(--text-base); font-weight: 800; color: #991b1b;">Tolak Pengajuan</div>
                            <div style="font-size: var(--text-sm); color: #991b1b; margin-top: var(--space-1);">Pengajuan akan ditolak dan catatan wajib diisi sebagai alasan.</div>
                        </div>
                        <div>
                            <label for="catatan-reject" style="font-size: var(--text-xs); color: var(--color-text-muted); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: var(--space-2);">Catatan Petugas (wajib)</label>
                            <textarea id="catatan-reject" name="catatan" rows="4" required style="width: 100%; padding: var(--space-3); border: 1px solid #fca5a5; border-radius: var(--radius-md); font-size: var(--text-sm); resize: vertical; background: white;" placeholder="Tuliskan alasan penolakan untuk UMKM.">{{ old('catatan') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-danger" style="width: 100%;" onclick="return confirm('Tolak pengajuan pendanaan ini?')">Tolak Pengajuan</button>
                </form>
            </div>
        </section>
    @endif

</div>
@endsection
