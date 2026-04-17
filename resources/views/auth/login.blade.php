@extends('layouts.auth')

@section('title', 'Masuk - SIP UMKM Kab. Bandung')

@section('content')
<div class="flex items-center justify-center w-full min-h-[70vh]">
    <!-- Card Container with Premium Style -->
    <div class="relative w-full max-w-md bg-white rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] border border-gray-100 overflow-hidden transform transition-all hover:shadow-[0_8px_40px_rgb(0,0,0,0.12)]">
        
        <!-- Decorative Top Border Gradient -->
        <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-600"></div>

        <div class="p-8 sm:p-10">
            <!-- Header -->
            <div class="text-center mb-10 mt-2">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-600 mb-6 shadow-sm border border-blue-100">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                        <polyline points="10 17 15 12 10 7"></polyline>
                        <line x1="15" y1="12" x2="3" y2="12"></line>
                    </svg>
                </div>
                <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-2">Selamat Datang Kembali</h1>
                <p class="text-sm text-gray-500">Masuk untuk mengelola usaha Anda secara digital.</p>
            </div>

            @if(session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-50 text-red-700 text-sm border border-red-200 flex items-center gap-3">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-6">
                @csrf
                
                <!-- Email Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-xs font-bold text-gray-700 uppercase tracking-widest">Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <input type="email" name="email" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-200" placeholder="nama@email.com" required>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center">
                        <label class="text-xs font-bold text-gray-700 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors">Lupa Password?</a>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </div>
                        <input type="password" name="password" class="w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:bg-white transition-all duration-200" placeholder="••••••••" required>
                        <span class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 cursor-pointer hover:text-gray-600 transition-colors">
                            <!-- Simple eye icon -->
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </span>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center gap-3 mt-1 cursor-pointer group">
                    <div class="relative flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 border-gray-300 rounded text-blue-600 focus:ring-blue-500 transition-shadow">
                    </div>
                    <label for="remember" class="text-sm text-gray-600 font-medium group-hover:text-gray-900 transition-colors cursor-pointer select-none">
                        Ingat Saya
                    </label>
                </div>

                <!-- Action Button -->
                <button type="submit" class="w-full mt-2 py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transform transition-all duration-200 hover:-translate-y-0.5 flex justify-center items-center gap-2">
                    Masuk ke Dashboard
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </button>
            </form>
            
            <!-- Register Link -->
            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="{{ route('umkm.register.step-1') }}" class="font-bold text-blue-600 hover:text-blue-800 transition-colors border-b-2 border-transparent hover:border-blue-600 pb-0.5">
                        Daftar sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
