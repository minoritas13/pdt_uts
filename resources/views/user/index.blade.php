@extends('layouts.user')

@section('title', 'Katalog Buku Terbaru — SPBT')

@push('styles')
<style>
    /* ─── HERO JUMBOTRON BANNER ─── */
    .hero-banner {
        margin: 30px 6%;
        border-radius: 20px;
        height: 380px;
        background: linear-gradient(90deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.2) 100%), 
                    url("{{ asset('images/banner.png') }}") no-repeat center center;
        background-size: cover;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 40px;
        overflow: hidden;
    }

    .hero-text-box {
        background: rgba(17, 44, 122, 0.85);
        padding: 35px;
        border-radius: 16px;
        color: var(--white);
        max-width: 480px;
        backdrop-filter: blur(4px);
    }

    .hero-text-box h1 {
        font-size: 28px;
        font-weight: 800;
        line-height: 1.3;
        margin-bottom: 12px;
        color: #f2b705;
    }

    .hero-text-box p {
        font-size: 14px;
        line-height: 1.6;
        color: rgba(255,255,255,0.9);
        margin-bottom: 24px;
    }

    .btn-cta {
        display: inline-block;
        padding: 12px 28px;
        background: var(--yellow);
        color: #112c7a;
        text-decoration: none;
        font-weight: 700;
        font-size: 13.5px;
        border-radius: 25px;
        transition: background 0.2s;
    }

    .btn-cta:hover { background: #e0aa04; }

    /* ─── FEATURES BENEFITS ─── */
    .features-section {
        background: #eaf3fc;
        padding: 50px 6%;
        text-align: center;
    }

    .section-title {
        font-size: 22px;
        font-weight: 800;
        color: #112c7a;
        margin-bottom: 6px;
    }

    .section-subtitle {
        font-size: 14px;
        color: #4b5563;
        margin-bottom: 35px;
        max-width: 600px;
        margin-left: auto; margin-right: auto;
        line-height: 1.5;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .feature-card {
        background: var(--white);
        padding: 30px 24px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(17,44,122,0.02);
    }

    .feature-icon-box {
        width: 50px; height: 50px;
        background: #f0f7fe;
        color: #0c73be;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px;
        font-size: 20px;
    }

    .feature-card h4 {
        font-size: 15px; font-weight: 700; color: #112c7a; margin-bottom: 10px;
    }

    .feature-card p {
        font-size: 12.5px; color: #6b7280; line-height: 1.6;
    }

    /* ─── CATALOG BOOK GRID ─── */
    .catalog-section {
        padding: 50px 6% 80px;
    }

    .catalog-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 24px;
    }

    .btn-see-all {
        color: #0c73be;
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 700;
    }

    .btn-see-all:hover { text-decoration: underline; }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }

    .book-card {
        background: var(--white);
        display: flex;
        flex-direction: column; /* Ditambahkan agar struktur internal bisa flex */
        transition: transform 0.2s;
    }

    .book-card:hover { transform: translateY(-4px); }

    .cover-wrapper {
        background: #f3f4f6;
        border-radius: 12px;
        height: 250px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    }

    .cover-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .book-info {
        display: flex;
        flex-direction: column;
        flex: 1; /* Mengisi sisa ruang card */
    }

    .book-info h4 {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1.4;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .book-author {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 6px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
    }

    .rating-row i { color: #f2b705; }

    .book-price {
        font-size: 14px;
        font-weight: 800;
        color: #112c7a;
        margin-top: auto; /* PERBAIKAN: Memaksa harga rata bawah di grid */
        margin-bottom: 12px;
    }

    .btn-add-cart {
        width: 100%;
        padding: 10px;
        border-radius: 20px;
        border: 1.5px solid var(--light-blue);
        background: var(--white);
        color: var(--light-blue);
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-add-cart:hover {
        background: var(--light-blue);
        color: var(--white);
    }

    /* ─── RESPONSIVE CATALOG ─── */
    @media (max-width: 1199px) {
        .books-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 991px) {
        .books-grid { grid-template-columns: repeat(3, 1fr); }
        .features-grid { grid-template-columns: 1fr; gap: 16px; }
    }
    @media (max-width: 576px) {
        .books-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
        .hero-banner { height: auto; padding: 20px; margin: 15px 4%; }
        .hero-text-box { padding: 20px; }
    }
</style>
@endpush

@section('content')

{{-- HERO BANNER RAK BUKU --}}
<section class="hero-banner">
    <div class="hero-text-box">
        <h1>Selamat datang di dunia penuh cerita!</h1>
        <p>Saatnya menambah koleksi bacaanmu! Dapatkan Diskon hingga 50% untuk ratusan buku favoritmu</p>
        <a href="#" class="btn-cta">Jelajahi Sekarang!</a>
    </div>
</section>

{{-- SEKAT FITUR / MANFAAT UTAMA --}}
<section class="features-section">
    <h2 class="section-title">Kenapa Harus SPBT?</h2>
    <p class="section-subtitle">SPBT hadir untuk menemani perjalananmu menemukan cerita, ide, dan inspirasi baru, dengan fitur yang terbaik dan menarik.</p>
    
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon-box"><i class="fa-solid fa-cubes"></i></div>
            <h4>Stok Terdistribusi</h4>
            <p>Data inventaris real-time dari ribuan titik distribusi seluruh negeri untuk memastikan ketersediaan buku favorit Anda.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon-box"><i class="fa-solid fa-credit-card"></i></div>
            <h4>Metode Pembayaran Lengkap</h4>
            <p>Pilih metode pembayaran untuk memudahkan dalam proses checkout buku yang kamu beli.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon-box"><i class="fa-solid fa-book-open"></i></div>
            <h4>Koleksi Lengkap</h4>
            <p>Akses ke jutaan judul buku dari berbagai genre, mulai dari fiksi, akademik hingga komik populer dalam satu genggaman.</p>
        </div>
    </div>
</section>

{{-- DAFTAR KATALOG UTAMA --}}
<section class="catalog-section">
    <div class="catalog-header">
        <div>
            <h2 class="section-title">Katalog Buku Terbaru</h2>
            <p style="font-size: 13px; color: #6b7280; margin-top: 2px;">Daftar buku baru yang baru saja ditambahkan ke sistem.</p>
        </div>
        {{-- Mengarahkan link "Lihat Semua" ke menu buku total --}}
        <a href="{{ route('buku.all') }}" class="btn-see-all">Lihat Semua &rarr;</a>
    </div>

    <div class="books-grid">
        @foreach($buku as $item)
        <div class="book-card">
            {{-- PERBAIKAN: Membungkus gambar cover dengan rute detail dinamis --}}
            <div class="cover-wrapper">
                <a href="{{ route('buku.detail', $item->id) }}" style="width: 100%; height: 100%; display: block;">
                    <img src="{{ asset('images/covers/' . ($item->id % 5 + 1) . '.jpg') }}" alt="{{ $item->judul }}">
                </a>
            </div>
            
            <div class="book-info">
                <h4>{{ $item->judul }}</h4>
                <div class="book-author">{{ $item->penulis }}</div>
                
                <div class="rating-row">
                    <span>5.0</span>
                    <div>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>

                <div class="book-price">Rp {{ number_format($item->harga_nasional, 0, ',', '.') }}</div>
                
                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-add-cart">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection
