<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPBT Admin')</title>
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
            --sidebar-w: 220px;
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
            padding: 20px 20px 24px;
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
            cursor: pointer;
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
            top: 0;
            z-index: 50;
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

{{-- Sidebar Overlay (mobile) --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

{{-- SIDEBAR --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">S</div>
        <span class="logo-text">SPBT Admin</span>
    </div>

    <nav class="sidebar-nav">
        <span class="nav-label">Menu Utama</span>

        <a href="{{ route('buku.index') }}"
           class="nav-item {{ request()->routeIs('buku.index') && !request()->has('manage') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
            </svg>
            Beranda
        </a>

        <span class="nav-label">Manajemen</span>

        <a href="{{ route('buku.index', ['manage' => 'true']) }}"
           class="nav-item {{ (request()->routeIs('buku.index') && request()->has('manage')) || request()->routeIs('buku.create', 'buku.edit', 'buku.show') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            Kelola Buku
        </a>

        <a href="{{ route('pusat.distribusi') }}"
           class="nav-item {{ request()->routeIs('pusat.distribusi*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            Distribusi Buku
        </a>

        <a href="{{ route('user.index') }}"
           class="nav-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Kelola User
        </a>

        <span class="nav-label">Laporan</span>

        <a href="{{ route('pusat.laporan.penjualan') }}"
           class="nav-item {{ request()->routeIs('pusat.laporan.penjualan') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Laporan Penjualan
        </a>

        <a href="{{ route('pusat.laporan.stok') }}"
           class="nav-item {{ request()->routeIs('pusat.laporan.stok') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            Laporan Stok
        </a>

        <a href="{{ route('pusat.laporan.distribusi') }}"
           class="nav-item {{ request()->routeIs('pusat.laporan.distribusi') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Laporan Distribusi
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Keluar Akun
            </button>
        </form>
    </div>
</aside>

{{-- MAIN --}}
<div class="main-wrapper">
    {{-- TOPBAR --}}
    <header class="topbar">
        <div style="display:flex; align-items:center; gap:14px;">
            <button class="hamburger" onclick="toggleSidebar()">
                <svg width="22" height="22" fill="none" stroke="#2d3561" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div class="topbar-search">
                <svg width="16" height="16" fill="none" stroke="#9aa3be" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0"/>
                </svg>
                <input type="text" placeholder="Cari data, transaksi, atau buku...">
            </div>
        </div>
        <div class="topbar-right">
            <div class="user-chip">
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="user-role">{{ auth()->user()->role ?? 'SUPER ADMIN' }}</div>
                </div>
                <div class="avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>
    </header>

    {{-- PAGE CONTENT --}}
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
