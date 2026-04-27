<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIP UMKM Kab. Bandung')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .auth-header {
            padding: var(--space-6) var(--space-10);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .auth-brand {
            font-size: 20px;
            font-weight: 800;
            color: var(--color-brand);
            letter-spacing: -0.02em;
        }
        .auth-nav {
            display: flex;
            gap: var(--space-6);
            font-size: 14px;
            font-weight: 500;
            color: var(--color-text-main);
        }
        .auth-main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: var(--space-10) var(--space-4);
        }
        .auth-footer {
            padding: var(--space-6) var(--space-10);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: var(--color-text-light);
            font-weight: 500;
            letter-spacing: 0.05em;
        }
        .footer-links {
            display: flex;
            gap: var(--space-6);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <header class="auth-header">
            <div class="auth-brand">SIP UMKM Kab. Bandung</div>
            <div class="auth-nav">
                <a href="#">Bantuan</a>
                <a href="#">Masuk</a>
            </div>
        </header>

        <main class="auth-main">
            <div class="max-w-base w-full flex-col gap-6">
                @yield('content')
            </div>
        </main>

        <footer class="auth-footer text-muted">
            <div class="uppercase">&copy; 2024 PEMERINTAH KABUPATEN BANDUNG. VERSI 2.1.0</div>
            <div class="footer-links uppercase">
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat &amp; Ketentuan</a>
            </div>
        </footer>
    </div>
    <script>
        function togglePassword(element) {
            const wrapper = element.closest('.relative');
            const input = wrapper.querySelector('input');
            if (input.type === 'password') {
                input.type = 'text';
                // Eye Off (Eye with a slash)
                element.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24M1 1l22 22"/></svg>';
            } else {
                input.type = 'password';
                // Eye (Normal)
                element.innerHTML = '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>';
            }
        }
    </script>
</body>
</html>
