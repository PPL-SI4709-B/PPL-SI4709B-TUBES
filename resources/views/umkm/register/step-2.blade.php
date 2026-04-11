@extends('layouts.auth')

@section('content')
<!-- Card Container -->
<div class="card mb-6">

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-xl font-bold text-dark tracking-tight mb-2">Daftar sebagai Pelaku UMKM</h1>
        <p class="text-sm text-muted m-0">Lengkapi data usaha Anda untuk melanjutkan pendaftaran.</p>
    </div>

    <!-- Stepper -->
    <div class="stepper-wrap mb-10">
        <!-- Connecting Line -->
        <div class="stepper-line">
             <div style="height: 100%; width: 50%; background-color: var(--color-brand);"></div>
        </div>
        
        <!-- Step 1: Completed -->
        <div class="step-item">
            <div class="step-circle done">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="step-label done">AKUN</div>
        </div>
        
        <!-- Step 2: Active -->
        <div class="step-item">
            <div class="step-circle active">2</div>
            <div class="step-label active">DATA USAHA</div>
        </div>
        
        <!-- Step 3: Inactive -->
        <div class="step-item">
            <div class="step-circle inactive">3</div>
            <div class="step-label inactive">KONFIRMASI</div>
        </div>
    </div>

    <form action="#" method="POST" class="flex-col gap-5">
        
        <!-- Nama Usaha -->
        <div class="flex-col gap-2">
            <label class="input-label">NAMA USAHA</label>
            <input type="text" class="input-field" placeholder="Masukkan nama usaha Anda">
        </div>

        <!-- Sektor Usaha -->
        <div class="flex-col gap-2">
            <label class="input-label">SEKTOR USAHA</label>
            <div class="relative">
                <select class="input-field text-muted" style="appearance: none; padding-right: 40px;">
                    <option>Pilih Sektor Usaha</option>
                    <option>Kuliner</option>
                    <option>Perdagangan</option>
                    <option>Fashion</option>
                    <option>Jasa</option>
                </select>
                <span class="absolute text-muted" style="right: 12px; top: 12px; pointer-events: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
        </div>

        <!-- Alamat Usaha -->
        <div class="flex-col gap-2">
            <label class="input-label">ALAMAT USAHA</label>
            <textarea class="input-field" rows="3" placeholder="Masukkan alamat lengkap usaha Anda" style="resize: vertical;"></textarea>
        </div>

        <!-- NIB -->
        <div class="flex-col gap-2">
            <label class="input-label">NIB (Opsional)</label>
            <input type="text" class="input-field" placeholder="Masukkan Nomor Induk Berusaha (jika ada)">
        </div>
        
        <!-- Omzet Tahunan -->
        <div class="flex-col gap-2 mb-2">
            <label class="input-label">OMZET TAHUNAN</label>
            <div class="relative">
                <select class="input-field text-muted" style="appearance: none; padding-right: 40px;">
                    <option>Pilih Omzet Tahunan</option>
                    <option>&lt; Rp 300 Juta</option>
                    <option>Rp 300 Juta - Rp 2 Miliar</option>
                    <option>&gt; Rp 2 Miliar</option>
                </select>
                <span class="absolute text-muted" style="right: 12px; top: 12px; pointer-events: none;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-4">
            <button type="button" class="btn btn-clear text-brand font-semibold">Kembali</button>
            <button type="button" class="btn btn-brand">
                Lanjut
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </div>

    </form>
</div>

<!-- Help Banner -->
<div class="help-banner">
    <div class="help-banner-line"></div>
    <div class="text-brand mt-1">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
    </div>
    <div>
        <h4 class="text-sm font-bold text-dark mb-1">Butuh bantuan pendaftaran?</h4>
        <p class="text-xs text-main m-0 leading-relaxed">Gunakan panduan pendaftaran atau hubungi WhatsApp Customer Service di 0812-XXXX-XXXX untuk bantuan langsung.</p>
    </div>
</div>
@endsection
