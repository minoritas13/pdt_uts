<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPBT Admin Cabang')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-spbt.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy: #1a2e5a;
            --navy-dark: #0f1e3d;
            --navy-light: #243671;
            --yellow: #f5c518;
            --yellow-hover: #e0b010;
            --white: #ffffff;
            --gray-50: #f8f9fc;
            --gray-100: #f0f2f8;
            --gray-200: #e2e6f0;
            --gray-400: #9aa3be;
            --gray-600: #5a6484;
            --gray-800: #2d3561;
            --green: #22c55e;
            --green-bg: #dcfce7;
            --yellow-bg: #fef9c3;
            --red: #ef4444;
            --red-bg: #fee2e2;
            --sidebar-w: 240px; /* Lebar disesuaikan agar teks menu nyaman dibaca */
            --topbar-h: 64px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            display: flex;
            min-height: 100vh;
        }

        /* ─── SIDEBAR ─── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--navy);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            transition: transform 0.3s ease;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .logo-icon {
            width: 36px; height: 36px;
            background: var(--yellow);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 800; color: var(--navy);
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 15px; font-weight: 700;
            color: var(--white); letter-spacing: 0.3px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 16px 12px;
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .nav-label {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255,255,255,0.35);
            letter-spacing: 1.2px;
            text-transform: uppercase;
            padding: 12px 8px 6px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.18s ease;
        }

        .nav-item:hover {
            background: rgba(255,255,255,0.08);
            color: var(--white);
        }

        .nav-item.active {
            background: var(--yellow);
            color: var(--navy-dark);
            font-weight: 700;
        }

        .nav-item.active .nav-icon { color: var(--navy-dark); }

        .nav-icon {
            width: 18px; height: 18px;
            flex-shrink: 0;
            opacity: 0.9;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: rgba(255,255,255,0.55);
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            background: none;
            border: none;
            transition: all 0.18s;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(239,68,68,0.15);
            color: #ff8080;
        }

        /* ─── MAIN CONTENT ─── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── TOPBAR ─── */
        .topbar {
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0; z-index: 50;
        }

        .topbar-search {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--gray-100);
            border-radius: 10px;
            padding: 8px 14px;
            width: 280px;
        }

        .topbar-search input {
            border: none;
            background: none;
            outline: none;
            font-size: 13.5px;
            color: var(--gray-800);
            font-family: 'Plus Jakarta Sans', sans-serif;
            width: 100%;
        }

        .topbar-search input::placeholder { color: var(--gray-400); }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-chip {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info { text-align: right; }

        .user-name {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--gray-800);
            line-height: 1.3;
        }

        .user-role {
            font-size: 11px;
            font-weight: 600;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--navy);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 14px;
        }

        /* ─── PAGE CONTENT ─── */
        .page-content {
            padding: 28px;
            flex: 1;
        }

        /* ─── RESPONSIVE ─── */
        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 99;
        }

        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .main-wrapper { margin-left: 0; }
            .hamburger { display: flex; }
            .topbar-search { width: 180px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">C</div>
        <span class="logo-text">SPBT Cabang</span>
    </div>

    <nav class="sidebar-nav">
        <span class="nav-label">Menu Utama</span>

        <a href="{{ route('cabang.penerimaan') }}"
           class="nav-item {{ request()->routeIs('cabang.penerimaan*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.75H6.912a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H15M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18" />
            </svg>
            Penerimaan Barang
        </a>

        <span class="nav-label">Pelaporan</span>

        <a href="{{ route('cabang.laporan.penjualan') }}"
           class="nav-item {{ request()->routeIs('cabang.laporan.penjualan') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Laporan Omzet
        </a>

        <a href="{{ route('cabang.laporan.terlaris') }}"
           class="nav-item {{ request()->routeIs('cabang.laporan.terlaris') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Buku Terlaris
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar Akun
            </button>
        </form>
    </div>
</aside>

<div class="main-wrapper">
    <header class="topbar">
        <div style="display:flex; align-items:center; gap:14px;">
            <button class="hamburger" onclick="toggleSidebar()">
                <svg width="22" height="22" fill="none" stroke="#2d3561" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="topbar-search">
                <svg width="16" height="16" fill="none" stroke="#9aa3be" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input type="text" placeholder="Cari laporan atau nomor struk...">
            </div>
        </div>
        <div class="topbar-right">
            <div class="user-chip">
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name ?? 'Admin Cabang' }}</div>
                    <div class="user-role">ADMIN CABANG</div>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    <main class="page-content">
        @yield('content')
    </main>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('open');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }
</script>

@stack('scripts')
</body>
</html>
