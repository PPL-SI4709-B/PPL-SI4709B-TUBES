@extends('layouts.auth')

@section('content')
<!-- Card Container -->
<div class="card mb-6">

    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-xl font-bold text-dark tracking-tight mb-2">Daftar sebagai Pelaku UMKM</h1>
        <p class="text-sm text-muted m-0">Lengkapi data diri Anda untuk mulai mengelola usaha secara digital.</p>
    </div>

    <x-stepper current="1" />

    <form action="{{ route('umkm.register.step-1.post') }}" method="POST" class="flex-col gap-5">
        @csrf
        
        <!-- Nama Lengkap Pemilik -->
        <div class="flex-col gap-2">
            <label class="input-label">NAMA LENGKAP PEMILIK</label>
            <input type="text" class="input-field" placeholder="Sesuai KTP">
        </div>

        <!-- Email -->
        <div class="flex-col gap-2">
            <label class="input-label">EMAIL</label>
            <input type="email" class="input-field" placeholder="contoh@email.com">
        </div>

        <!-- No HP -->
        <div class="flex-col gap-2">
            <label class="input-label">NO. HP/WHATSAPP</label>
            <div class="flex">
                <div class="input-prefix">+62</div>
                <input type="tel" class="input-field input-with-prefix" placeholder="8123456xxx">
            </div>
        </div>

        <!-- Password Row -->
        <div class="grid grid-cols-2 gap-4">
            <!-- Password Field -->
            <div class="flex-col gap-2">
                <label class="input-label">PASSWORD</label>
                <div class="relative">
                    <input type="password" class="input-field" placeholder="••••••••" style="padding-right: 40px;">
                    <span class="absolute text-light" style="right: 12px; top: 12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24M1 1l22 22"/></svg>
                    </span>
                </div>
                
                <!-- Strength indicator -->
                <div class="mt-1">
                    <div class="flex gap-1 mb-2">
                        <div class="flex-1 bg-brand" style="height: 4px; border-radius: 2px;"></div>
                        <div class="flex-1 bg-brand" style="height: 4px; border-radius: 2px;"></div>
                        <div class="flex-1" style="height: 4px; border-radius: 2px; background-color: var(--color-border);"></div>
                        <div class="flex-1" style="height: 4px; border-radius: 2px; background-color: var(--color-border);"></div>
                    </div>
                    <div class="text-xs text-muted" style="font-style: italic;">Kekuatan: Sedang</div>
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div class="flex-col gap-2">
                <label class="input-label">KONFIRMASI PASSWORD</label>
                <div class="relative">
                    <input type="password" class="input-field" placeholder="••••••••" style="padding-right: 40px;">
                    <span class="absolute text-light" style="right: 12px; top: 12px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24M1 1l22 22"/></svg>
                    </span>
                </div>
            </div>
        </div>

        <!-- Checkbox -->
        <div class="flex items-start gap-3 mt-3 mb-3">
            <label class="custom-checkbox">
                <input type="checkbox" checked>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </label>
            <div class="text-sm text-main" style="line-height: 1.5; padding-top: 1px;">
                Saya menyetujui <a href="#" class="link-brand">syarat dan ketentuan</a> yang berlaku di portal SIP UMKM Kab. Bandung.
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-between items-center mt-4">
            <a href="{{ route('login') }}" class="btn btn-clear inline-flex items-center justify-center">Batal</a>
            <button type="submit" class="btn btn-brand">
                Lanjut
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
        </div>

    </form>
</div>

<x-help-banner />
@endsection
