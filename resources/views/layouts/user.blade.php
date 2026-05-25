<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPBT — Dunia Penuh Cerita')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-spbt.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary-blue: #112c7a; /* Biru Dongker Premium Utama */
            --light-blue: #0c73be;
            --soft-blue: #e8f3fc;
            --yellow: #f2b705;
            --white: #ffffff;
            --gray-sub: #9aa3be;
            --text-dark: #1e293b;
            --bg-light: #ffffff;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ─── HEADER NAVBAR ─── */
        .header-navbar {
            background: var(--primary-blue);
            padding: 16px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--white);
            text-decoration: none;
        }

        .logo-img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .logo-title {
            font-size: 22px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
            list-style: none;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 600;
            transition: color 0.2s;
        }

        .nav-links a:hover, .nav-links a.active {
            color: var(--white);
        }

        .search-container {
            flex: 1;
            max-width: 500px;
            position: relative;
            margin: 0 10px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 20px 12px 46px;
            border-radius: 12px;
            border: none;
            outline: none;
            font-size: 14px;
            font-family: inherit;
            color: var(--text-dark);
            background: var(--white);
        }

        .search-container i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #7e8ba1;
            font-size: 15px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .cart-wrapper {
            position: relative;
            background: var(--light-blue);
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: transform 0.2s;
        }

        .cart-wrapper:hover { transform: scale(1.05); }

        .cart-badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: red;
            color: white;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 10px;
            border: 2px solid var(--primary-blue);
        }

        .profile-menu-btn {
            background: rgba(255, 255, 255, 0.2);
            width: 42px;
            height: 42px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            cursor: pointer;
            border: none;
            font-size: 18px;
            position: relative;
        }

        /* ─── DROPDOWN OUT/LOGOUT ─── */
        .profile-dropdown {
            position: absolute;
            right: 0;
            top: 50px;
            background: var(--white);
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            width: 160px;
            display: none;
            overflow: hidden;
        }

        .profile-dropdown button {
            width: 100%;
            padding: 12px;
            background: none;
            border: none;
            text-align: left;
            font-family: inherit;
            font-size: 13.5px;
            font-weight: 600;
            color: #ef4444;
            cursor: pointer;
        }

        .profile-dropdown button:hover { background: #fef2f2; }

        .main-container {
            flex: 1;
        }

        /* ─── FOOTER SYSTEM ─── */
        .footer-section {
            background: var(--primary-blue);
            color: var(--white);
            padding: 60px 6% 30px;
            margin-top: auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .footer-about p {
            font-size: 14px;
            color: rgba(255,255,255,0.75);
            line-height: 1.6;
            margin-top: 15px;
            max-width: 340px;
        }

        .footer-column h4 {
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--white);
        }

        .footer-column ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .footer-column ul a {
            color: rgba(255,255,255,0.75);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.15s;
        }

        .footer-column ul a:hover { color: var(--white); }

        .social-row {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .social-icon {
            color: var(--white);
            font-size: 22px;
            opacity: 0.85;
            transition: opacity 0.2s;
        }

        .social-icon:hover { opacity: 1; }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            font-size: 13px;
            color: rgba(255,255,255,0.6);
        }

        /* ─── RESPONSIVE NAVBAR ─── */
        @media (max-width: 991px) {
            .footer-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 768px) {
            .header-navbar { padding: 14px 4%; flex-wrap: wrap; }
            .search-container { order: 3; max-width: 100%; width: 100%; margin: 10px 0 0; }
            .footer-grid { grid-template-columns: 1fr; gap: 30px; }
            .nav-links { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- NAVBAR HEADER --}}
<header class="header-navbar">
    <a href="{{ route('katalog.index') }}" class="brand-logo">
        <img src="{{ asset('images/logo-spbt.png') }}" class="logo-img" alt="Logo SPBT">
        <span class="logo-title">SPBT</span>
    </a>

    <ul class="nav-links">
        <li>
            <a href="{{ route('katalog.index') }}" class="{{ request()->routeIs('katalog.index') ? 'active' : '' }}">Beranda</a>
        </li>
        <li>
            <a href="{{ route('buku.all') }}" class="{{ request()->routeIs('buku.all') ? 'active' : '' }}">Buku</a>
        </li>
    </ul>

    <div class="search-container">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search">
    </div>

    <div class="header-actions">
        {{-- Keranjang Belanja Berdesain Persis Kotak Biru Muda --}}
        <a href="{{ route('cart.show') }}" class="cart-wrapper">
            <i class="fa-solid fa-cart-shopping"></i>
            @if(count((array) session('cart')) > 0)
                <span class="cart-badge">{{ count((array) session('cart')) }}</span>
            @endif
        </a>

        {{-- Tombol Akun Avatar --}}
        <div style="position: relative;">
            <button class="profile-menu-btn" onclick="toggleProfileDropdown()">
                <i class="fa-solid fa-user"></i>
            </button>
            <div class="profile-dropdown" id="profileDropdown">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar (Logout)
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>

{{-- MAIN CONTENT INJECTOR --}}
<main class="main-container">
    @yield('content')
</main>

{{-- FOOTER SECTION --}}
<footer class="footer-section">
    <div class="footer-grid">
        <div class="footer-about">
            <a href="/" class="brand-logo">
                <img src="{{ asset('images/logo-spbt.png') }}" class="logo-img" alt="Logo SPBT">
                <span class="logo-title">SPBT</span>
            </a>
            <p>Bangun masa depan lewat setiap halaman yang kamu baca. Setiap buku membawa ilmu, ide, dan harapan baru. Karena pengetahuan adalah investasi terbaik sepanjang masa.</p>
        </div>

        <div class="footer-column">
            <h4>Informasi</h4>
            <ul>
                <li><a href="#">Tentang Kami</a></li>
                <li><a href="#">Akun Saya</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Kategori</h4>
            <ul>
                <li><a href="#">Fiksi</a></li>
                <li><a href="#">Non-Fiksi</a></li>
                <li><a href="#">Buku Akademik</a></li>
                <li><a href="#">Komik</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h4>Ikuti Kami</h4>
            <div class="social-row">
                <a href="#" class="social-icon"><i class="fa-brands fa-facebook"></i></a>
                <a href="#" class="social-icon"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        @2026 Sistem Penjualan Buku Terdistribusi, All Right Reserved
    </div>
</footer>

<script>
    function toggleProfileDropdown() {
        const dd = document.getElementById('profileDropdown');
        dd.style.display = dd.style.display === 'block' ? 'none' : 'block';
    }
    // Tutup dropdown jika klik di luar area profil
    window.onclick = function(event) {
        if (!event.target.matches('.profile-menu-btn') && !event.target.matches('.profile-menu-btn *')) {
            document.getElementById('profileDropdown').style.display = 'none';
        }
    }
</script>
@stack('scripts')
</body>
</html>
