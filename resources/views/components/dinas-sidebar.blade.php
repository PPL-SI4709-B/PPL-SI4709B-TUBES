@props(['active' => ''])

@php
    $hasRoute = fn (string $name): bool => \Illuminate\Support\Facades\Route::has($name);
@endphp

<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-title">PORTAL UMKM</div>
        <div class="brand-subtitle">Kabupaten Bandung</div>
    </div>

    <nav class="nav-menu">
        @if($hasRoute('dinas.dashboard'))
        <a href="{{ route('dinas.dashboard') }}" class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></span>
            Beranda
        </a>
        @endif

        @if($hasRoute('dinas.verification.index'))
        <a href="{{ route('dinas.verification.index') }}" class="nav-item {{ $active === 'verification' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Verifikasi UMKM
        </a>
        @endif

        @if($hasRoute('dinas.program.index'))
        <a href="{{ route('dinas.program.index') }}" class="nav-item {{ $active === 'program' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg></span>
            Kelola Program
        </a>
        @endif

        @if($hasRoute('dinas.pengajuan.index'))
        <a href="{{ route('dinas.pengajuan.index') }}" class="nav-item {{ $active === 'pengajuan' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"></path><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg></span>
            Approval Pengajuan
        </a>
        @endif

        @if($hasRoute('dinas.report.index'))
        <a href="{{ route('dinas.report.index') }}" class="nav-item {{ $active === 'report' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg></span>
            Review Laporan
        </a>
        @endif

        @if($hasRoute('dinas.master-data'))
        <a href="{{ route('dinas.master-data') }}" class="nav-item {{ $active === 'master-data' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>
            Master Data
        </a>
        @endif

        @if($hasRoute('dinas.sumber-pendanaan.index'))
        <a href="{{ route('dinas.sumber-pendanaan.index') }}" class="nav-item {{ $active === 'sumber-pendanaan' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22"></path><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></span>
            Sumber Pendanaan
        </a>
        @endif

        @if($hasRoute('dinas.pendanaan-verifikasi.index'))
        <a href="{{ route('dinas.pendanaan-verifikasi.index') }}" class="nav-item {{ $active === 'pendanaan-verifikasi' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4"></path><circle cx="12" cy="12" r="9"></circle></svg></span>
            Verifikasi Pendanaan
        </a>
        @endif

        @if($hasRoute('dinas.event.index'))
        <a href="{{ route('dinas.event.index') }}" class="nav-item {{ $active === 'event' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event dan Pelatihan
        </a>
        @endif
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('dinas-logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="dinas-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
