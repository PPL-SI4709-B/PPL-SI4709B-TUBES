<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal UMKM Kabupaten Bandung')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="auth-shell">
        <section class="auth-hero fade-in">
            <div class="auth-brand">
                <span class="auth-brand-mark">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                </span>
                Portal UMKM Kabupaten Bandung
            </div>

            <div class="auth-hero-content">
                <div>
                    <h1 class="auth-title">Satu portal untuk mengembangkan UMKM Kabupaten Bandung.</h1>
                    <p class="auth-subtitle">Kelola profil usaha, ajukan pendanaan, ikuti event pelatihan, dan kirim laporan berkala dalam satu sistem terpadu.</p>
                </div>

                <div class="auth-highlight-grid">
                    <div class="auth-highlight"><span></span>Pendataan UMKM</div>
                    <div class="auth-highlight"><span></span>Event &amp; Pelatihan</div>
                    <div class="auth-highlight"><span></span>Pendanaan Usaha</div>
                </div>
            </div>

            <div class="floating-card">
                <div class="stat-label" style="color: rgba(255,255,255,0.68);">Layanan Terpadu</div>
                <div style="font-size: 1.35rem; font-weight: 800; color: #FFFFFF; margin-top: var(--space-2); line-height: 1.25;">Profil, pendanaan, event, dan laporan berkala.</div>
                <div style="height: 0.5rem; background: rgba(255,255,255,0.18); border-radius: var(--radius-full); overflow: hidden; margin-top: var(--space-4);">
                    <div style="height: 100%; width: 72%; background: var(--color-accent-gold); border-radius: inherit;"></div>
                </div>
            </div>

            <div class="auth-blob"></div>
        </section>

        <main class="auth-panel fade-in">
            <div class="auth-panel-inner">
                @yield('content')
            </div>
            <footer class="auth-footer">
                <div>&copy; 2026 Pemerintah Kabupaten Bandung</div>
                <div>Portal UMKM versi 2.1.0</div>
            </footer>
        </main>
    </div>

    <script>
        function togglePassword(element) {
            const wrapper = element.closest('.relative');
            const input = wrapper.querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                element.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24M1 1l22 22"/></svg>';
            } else {
                input.type = 'password';
                element.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            }
        }
    </script>
</body>
</html>
