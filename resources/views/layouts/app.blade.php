<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal UMKM')</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .dashboard-layout {
            display: flex;
            height: 100vh;
            overflow: hidden;
            background-color: var(--color-bg);
        }
        
        .sidebar {
            width: 16rem;
            background-color: var(--color-primary);
            color: white;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            overflow-y: auto;
        }

        .sidebar.sidebar-light {
            background-color: #f8fafc;
            color: var(--color-text);
            border-right: 1px solid var(--color-border);
        }

        .sidebar-brand {
            padding: var(--space-6);
            padding-bottom: var(--space-8);
        }

        .brand-title {
            font-size: var(--text-lg);
            font-weight: 800;
            letter-spacing: -0.02em;
        }

        .sidebar-light .brand-title {
            color: var(--color-primary);
        }

        .brand-subtitle {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 2px;
        }

        .sidebar-light .brand-subtitle {
            color: var(--color-text-muted);
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 2px;
            padding: 0 var(--space-4);
            flex: 1;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-3) var(--space-4);
            border-radius: var(--radius-md);
            color: rgba(255, 255, 255, 0.75);
            font-size: var(--text-sm);
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-light .nav-item {
            color: var(--color-text-muted);
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: white;
        }

        .sidebar-light .nav-item:hover {
            background-color: var(--color-bg);
            color: var(--color-text);
        }

        .nav-item.active {
            background-color: var(--color-secondary); /* #0056b3 approx for dinas */
            color: white;
        }

        .sidebar-light .nav-item.active {
            background-color: white;
            color: var(--color-primary);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--color-border);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-bottom {
            padding: var(--space-6);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            color: rgba(255, 255, 255, 0.75);
            font-size: var(--text-sm);
            font-weight: 500;
        }

        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            background-color: var(--color-bg);
        }

        .main-header {
            height: 4.5rem;
            background-color: white;
            border-bottom: 1px solid var(--color-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 var(--space-8);
            flex-shrink: 0;
            z-index: 10;
        }

        .page-title {
            font-size: var(--text-lg);
            font-weight: 700;
            color: var(--color-primary);
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: var(--space-8);
        }

        /* User Profile in Header/Sidebar */
        .user-profile {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .user-info {
            text-align: right;
        }

        .user-name {
            font-weight: 600;
            font-size: var(--text-sm);
            color: var(--color-gray-900);
            line-height: 1.2;
        }

        .user-role {
            font-size: 0.65rem;
            color: var(--color-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .user-avatar {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            background-color: var(--color-primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            overflow: hidden;
        }
        
        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Fixed user card bottom alternative */
        .user-card-bottom {
            background-color: #f1f5f9;
            border-radius: var(--radius-lg);
            padding: var(--space-3);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }
        
        .user-card-bottom .user-info {
            text-align: left;
        }

        /* Modal Overlay */
        .modal-overlay {
            position: absolute;
            top: 0; right: 0; bottom: 0; left: 0;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: 40;
            display: none;
        }

        .slide-panel {
            position: absolute;
            top: 0; right: 0; bottom: 0;
            width: 32rem; /* 512px */
            background-color: white;
            box-shadow: var(--shadow-lg);
            z-index: 50;
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
        }

        .slide-panel.open {
            transform: translateX(0);
        }
        
        .modal-overlay.open {
            display: block;
        }

    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        @yield('sidebar')

        <!-- Main Wrapper -->
        <div class="main-wrapper">
            <!-- Header -->
            @yield('header')

            <!-- Main Content Area -->
            <main class="main-content">
                @yield('content')
            </main>
            
            <!-- Global Overlays / Modals -->
            @yield('modals')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
