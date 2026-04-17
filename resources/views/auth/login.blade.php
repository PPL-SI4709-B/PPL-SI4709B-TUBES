@extends('layouts.auth')

@section('title', 'Masuk - SIP UMKM Kab. Bandung')

@section('content')
<div class="card w-full mx-auto" style="max-width: 440px;">
    
    <!-- Header -->
    <div class="text-center mb-10">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-6" style="background-color: var(--color-input-bg); color: var(--color-brand);">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                <polyline points="10 17 15 12 10 7"></polyline>
                <line x1="15" y1="12" x2="3" y2="12"></line>
            </svg>
        </div>
        <h1 class="text-xl font-bold text-dark tracking-tight mb-2">Selamat Datang Kembali</h1>
        <p class="text-sm text-muted m-0">Masuk untuk mulai mengelola usaha secara digital.</p>
    </div>

    @if(session('error'))
        <div class="mb-6 p-4 rounded-lg flex items-center gap-3" style="background-color: var(--color-status-reject-bg); color: var(--color-status-reject-text);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <span class="text-sm font-semibold">{{ session('error') }}</span>
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" class="flex-col gap-5">
        @csrf

        <!-- Email Field -->
        <div class="flex-col gap-2">
            <label class="input-label">EMAIL</label>
            <input type="email" name="email" class="input-field" placeholder="contoh@email.com" required>
        </div>

        <!-- Password Field -->
        <div class="flex-col gap-2">
            <div class="flex justify-between items-center">
                <label class="input-label">PASSWORD</label>
                <a href="#" class="text-xs font-semibold link-brand" style="text-decoration: underline;">Lupa Password?</a>
            </div>
            <div class="relative">
                <input type="password" name="password" class="input-field" placeholder="••••••••" style="padding-right: 40px;" required>
                <span class="absolute text-light" style="right: 12px; top: 12px; cursor: pointer;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </span>
            </div>
        </div>

        <!-- Checkbox / Remember -->
        <div class="flex items-start gap-3 mt-2 mb-4">
            <label class="custom-checkbox">
                <input type="checkbox" name="remember" checked>
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </label>
            <div class="text-sm text-main" style="line-height: 1.5; padding-top: 1px;">
                Ingat Saya
            </div>
        </div>

        <!-- Action Button -->
        <button type="submit" class="btn btn-brand w-full justify-center mt-2" style="padding-top: 14px; padding-bottom: 14px;">
            Masuk ke Dashboard
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
        </button>
    </form>

    <div class="text-center mt-8 pt-6 text-sm text-main" style="border-top: 1px solid var(--color-border);">
        Belum punya akun? <a href="{{ route('umkm.register.step-1') }}" class="link-brand">Daftar sekarang</a>
    </div>
    
</div>
@endsection
