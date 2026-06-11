@props(['active' => ''])

@php
    $hasRoute = fn (string $name): bool => \Illuminate\Support\Facades\Route::has($name);
@endphp

<aside class="sidebar">
    <div class="sidebar-brand flex items-center gap-3">
        <div style="background: white; border-radius: var(--radius-sm); padding: 0.25rem;">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
        </div>
        <div>
            <div class="brand-title" style="font-size: 1rem; line-height: 1.1;">PORTAL UMKM</div>
            <div class="brand-subtitle" style="font-size: 0.65rem; color: rgba(255,255,255,0.7);">KABUPATEN BANDUNG</div>
        </div>
    </div>

    <nav class="nav-menu">
        @if($hasRoute('umkm.dashboard'))
        <a href="{{ route('umkm.dashboard') }}" class="nav-item {{ $active === 'dashboard' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg></span>
            Beranda
        </a>
        @endif

        @if($hasRoute('umkm.profile.show'))
        <a href="{{ route('umkm.profile.show') }}" class="nav-item {{ $active === 'profile' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></span>
            Profil UMKM
        </a>
        @endif

        @if($hasRoute('umkm.pendanaan.index'))
        <a href="{{ route('umkm.pendanaan.index') }}" class="nav-item {{ $active === 'pendanaan' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 1v22"></path><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg></span>
            Pengajuan Pendanaan
        </a>
        @endif

        @if($hasRoute('umkm.event'))
        <a href="{{ route('umkm.event') }}" class="nav-item {{ $active === 'event' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg></span>
            Event dan Pelatihan
        </a>
        @endif

        @if($hasRoute('umkm.event.history'))
        <a href="{{ route('umkm.event.history') }}" class="nav-item {{ $active === 'event-history' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v5h5"></path><path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"></path></svg></span>
            Riwayat Event
        </a>
        @endif

        @if($hasRoute('umkm.laporan_berkala.index'))
        <a href="{{ route('umkm.laporan_berkala.index') }}" class="nav-item {{ $active === 'laporan-berkala' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg></span>
            Laporan Berkala
        </a>
        @endif

        @if($hasRoute('umkm.materi-edukasi.index'))
        <a href="{{ route('umkm.materi-edukasi.index') }}" class="nav-item {{ $active === 'materi-edukasi' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v17a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v17a3 3 0 0 1 3-3h7z"></path></svg></span>
            Materi Edukasi
        </a>
        @endif

        @if($hasRoute('umkm.notifications.index'))
        <a href="{{ route('umkm.notifications.index') }}" class="nav-item {{ $active === 'notifications' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></span>
            Notifikasi
        </a>
        @endif

        @if($hasRoute('umkm.faq'))
        <a href="{{ route('umkm.faq') }}" class="nav-item {{ $active === 'faq' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg></span>
            FAQ dan Bantuan
        </a>
        @endif

        @if($hasRoute('umkm.panduan'))
        <a href="{{ route('umkm.panduan') }}" class="nav-item {{ $active === 'panduan' ? 'active' : '' }}">
            <span class="nav-icon"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg></span>
            Panduan
        </a>
        @endif
    </nav>

    <div class="sidebar-bottom">
        <a href="#" class="logout-btn" onclick="event.preventDefault(); document.getElementById('umkm-logout-form').submit();">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
            Keluar
        </a>
        <form id="umkm-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</aside>
