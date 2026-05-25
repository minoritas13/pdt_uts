<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPBT Kasir Cabang')</title>
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
            --white: #ffffff;
            --gray-50: #f8f9fc;
            --gray-100: #f0f2f8;
            --gray-200: #e2e6f0;
            --gray-400: #9aa3be;
            --gray-600: #5a6484;
            --gray-800: #2d3561;
            --green: #22c55e;
            --green-bg: #dcfce7;
            --red: #ef4444;
            --red-bg: #fee2e2;
            --sidebar-w: 240px;
            --topbar-h: 64px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--gray-50);
            color: var(--gray-800);
            display: flex;
            min-height: 100vh;
        }

        /* ─── SIDEBAR KASIR ─── */
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

        .nav-icon { width: 18px; height: 18px; flex-shrink: 0; }

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
        }

        .logout-btn:hover {
            background: rgba(239,68,68,0.15);
            color: #ff8080;
        }

        /* ─── MAIN WRAPPER ─── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            flex: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

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

        .user-chip { display: flex; align-items: center; gap: 10px; }
        .user-info { text-align: right; }
        .user-name { font-size: 13.5px; font-weight: 700; color: var(--gray-800); }
        .user-role { font-size: 11px; font-weight: 600; color: var(--gray-400); text-transform: uppercase; }
        
        .avatar {
            width: 36px; height: 36px; border-radius: 50%; background: var(--navy);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: 14px;
        }

        .page-content { padding: 28px; flex: 1; display: flex; flex-direction: column; }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="logo-icon">S</div>
        <span class="logo-text">SPBT Kasir</span>
    </div>

    <nav class="sidebar-nav">
        <span class="nav-label">Menu Utama</span>
        <a href="{{ route('kasir.pos') }}" class="nav-item {{ request()->routeIs('kasir.pos') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 11-6 0 3 3 0 016 0zm12.75 0a3 3 0 11-6 0 3 3 0 016 0zM17.25 15.75H7.5V5.25h12.75l-1.34 6.03a1.5 1.5 0 01-1.42 1.22H8.25" />
            </svg>
            Mesin Kasir (POS)
        </a>
        <a href="{{ route('kasir.online') }}" class="nav-item {{ request()->routeIs('kasir.online') ? 'active' : '' }}">
            <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
            Pesanan Online
        </a>
    </nav>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M19.5 12l-3-3m3 3l-3 3m3-3H9" />
                </svg>
                Keluar Akun
            </button>
        </form>
    </div>
</aside>

<div class="main-wrapper">
    <header class="topbar">
        <div></div>
        <div class="topbar-right">
            <div class="user-chip">
                <div class="user-info">
                    <div class="user-name">{{ auth()->user()->name ?? 'Kasir Cabang' }}</div>
                    <div class="user-role">KASIR TOKO</div>
                </div>
                <div class="avatar">K</div>
            </div>
        </div>
    </header>

    <div class="page-content">
        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
