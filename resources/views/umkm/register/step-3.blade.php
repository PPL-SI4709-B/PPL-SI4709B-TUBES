@extends('layouts.auth')

@section('content')
<!-- Card Container -->
<div class="card mb-6" style="max-width: 640px; width: 100%;">

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-xl font-bold text-dark tracking-tight mb-2">Konfirmasi Pendaftaran</h1>
        <p class="text-sm text-muted m-0">Lengkapi data usaha Anda untuk melanjutkan pendaftaran.</p>
    </div>

    <!-- Stepper -->
    <div class="stepper-wrap mb-10">
        <!-- Connecting Line -->
        <div class="stepper-line">
             <div style="height: 100%; width: 100%; background-color: var(--color-brand);"></div>
        </div>
        
        <!-- Step 1: Completed -->
        <div class="step-item">
            <div class="step-circle done">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="step-label done">AKUN</div>
        </div>
        
        <!-- Step 2: Completed -->
        <div class="step-item">
            <div class="step-circle done">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="step-label done">DATA USAHA</div>
        </div>
        
        <!-- Step 3: Active -->
        <div class="step-item">
            <div class="step-circle active">3</div>
            <div class="step-label active">KONFIRMASI</div>
        </div>
    </div>

    <form action="#" method="POST" class="flex-col gap-6">
        
        <!-- Summary Cards -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Account Summary -->
            <div class="relative p-6" style="border: 1px solid var(--color-border); border-radius: var(--radius-lg);">
                <button type="button" class="absolute bg-input-bg text-muted" style="top: 20px; right: 20px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #F1F5F9;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                </button>
                
                <h3 class="text-base font-bold text-dark mb-4 tracking-tight" style="padding-right: 40px;">Ringkasan Data Akun</h3>
                
                <div class="flex-col gap-3">
                    <div>
                        <div class="text-xs text-muted mb-1">Nama Lengkap</div>
                        <div class="text-sm font-semibold text-dark">Budi Santoso</div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">Email</div>
                        <div class="text-sm font-semibold text-dark">budi.santoso@email.com</div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">Nomor HP</div>
                        <div class="text-sm font-semibold text-dark">081234567890</div>
                    </div>
                </div>
            </div>

            <!-- Business Summary -->
            <div class="relative p-6" style="border: 1px solid var(--color-border); border-radius: var(--radius-lg);">
                <button type="button" class="absolute bg-input-bg text-muted" style="top: 20px; right: 20px; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #F1F5F9;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                </button>
                
                <h3 class="text-base font-bold text-dark mb-4 tracking-tight" style="padding-right: 40px;">Ringkasan Data Usaha</h3>
                
                <div class="flex-col gap-3">
                    <div>
                        <div class="text-xs text-muted mb-1">Nama Usaha</div>
                        <div class="text-sm font-semibold text-dark">Warung Sejahtera</div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">Sektor Usaha</div>
                        <div class="text-sm font-semibold text-dark">Perdagangan</div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">Alamat Usaha</div>
                        <div class="text-sm font-semibold text-dark" style="line-height: 1.4;">Jl. Merdeka No. 123, Bandung</div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">NIB</div>
                        <div class="text-sm font-semibold text-dark">1234567890123 <span class="text-muted font-medium">(Opsional)</span></div>
                    </div>
                    <div>
                        <div class="text-xs text-muted mb-1">Omzet Tahunan</div>
                        <div class="text-sm font-semibold text-dark">&lt; Rp 300 Juta</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Confimation Checkbox Banner -->
        <div class="flex items-start gap-4 p-4 mt-2" style="background-color: #eff6ff; border-radius: var(--radius-md);">
            <label class="custom-checkbox bg-white" style="border: 1px solid var(--color-border); border-radius: var(--radius-sm); margin-top: 2px;">
                <input type="checkbox">
            </label>
            <label class="text-sm text-dark font-medium leading-snug cursor-pointer">
                Saya menyatakan bahwa data yang saya isi adalah benar dan dapat dipertanggungjawabkan.
            </label>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-2">
            <button type="button" class="btn btn-clear text-brand font-semibold">Kembali</button>
            <button type="button" class="btn btn-brand">
                Selesai &amp; Daftar
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </button>
        </div>

    </form>
</div>

<!-- Help Banner -->
<div class="help-banner" style="max-width: 640px; margin: 0 auto; width: 100%;">
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
