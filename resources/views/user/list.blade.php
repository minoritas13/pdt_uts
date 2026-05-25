@extends('layouts.user')

@section('title', 'Eksplorasi Pengetahuan Tanpa Batas — SPBT')

@push('styles')
<style>
    .books-page-container {
        padding: 40px 6% 80px;
        background-color: #ffffff;
    }

    /* ─── BANNER HEADER TEXT ─── */
    .explore-header {
        margin-bottom: 30px;
    }

    .explore-header h2 {
        font-size: 26px;
        font-weight: 800;
        color: #112c7a;
    }

    .explore-header h2 span {
        color: #f2b705;
    }

    .explore-header p {
        font-size: 14px;
        color: #4b5563;
        margin-top: 6px;
        line-height: 1.5;
    }

    /* ─── SEARCH & FILTER UTILITY BAR ─── */
    .utility-bar-form {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 35px;
        width: 100%;
    }

    .search-box-wrapper {
        position: relative;
        flex: 2;
        max-width: 400px;
    }

    .search-box-wrapper input {
        width: 100%;
        padding: 11px 16px 11px 42px;
        border-radius: 30px;
        border: 1px solid #cbd5e1;
        font-family: inherit;
        font-size: 13.5px;
        outline: none;
        color: var(--text-dark);
        background: #ffffff;
    }

    .search-box-wrapper i {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aa3be;
        font-size: 14px;
    }

    .filter-select-wrapper {
        flex: 1;
        max-width: 200px;
    }

    .filter-select-wrapper select {
        width: 100%;
        padding: 11px 20px;
        border-radius: 30px;
        border: 1px solid #cbd5e1;
        font-family: inherit;
        font-size: 13.5px;
        color: #1e293b;
        background-color: #ffffff;
        outline: none;
        cursor: pointer;
    }

    .btn-search-submit {
        padding: 11px 24px;
        border-radius: 30px;
        background: #112c7a;
        color: #ffffff;
        border: none;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }

    .btn-search-submit:hover {
        background: #0c73be;
    }

    /* ─── GRID KATALOG PRODUK ─── */
    .books-product-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        column-gap: 20px;
        row-gap: 35px;
    }

    .product-card {
        background: #ffffff;
        display: flex;
        flex-direction: column;
        transition: transform 0.2s;
    }

    .product-card:hover {
        transform: translateY(-4px);
    }

    .product-cover-box {
        background: #f3f4f6;
        border-radius: 12px;
        height: 250px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    }

    .product-cover-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-info {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-info h4 {
        font-size: 14.5px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.4;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-author {
        font-size: 12px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .product-stock {
        font-size: 12px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 4px;
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .product-rating i {
        color: #f2b705;
    }

    .product-price {
        font-size: 14.5px;
        font-weight: 800;
        color: #112c7a;
        margin-top: auto;
        margin-bottom: 10px;
    }

    .btn-card-add {
        width: 100%;
        padding: 9px;
        border-radius: 20px;
        border: 1.5px solid #0c73be;
        background: #ffffff;
        color: #0c73be;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-card-add:hover {
        background: #0c73be;
        color: #ffffff;
    }

    /* ─── RESPONSIVE LAYOUT ─── */
    @media (max-width: 1200px) {
        .books-product-grid { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 992px) {
        .books-product-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 640px) {
        .books-product-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
        .utility-bar-form { flex-direction: column; align-items: stretch; gap: 10px; }
        .search-box-wrapper, .filter-select-wrapper, .btn-search-submit { max-width: 100%; width: 100%; }
        .btn-search-submit { justify-content: center; }
        .explore-header h2 { font-size: 22px; }
    }
</style>
@endpush

@section('content')

<div class="books-page-container">
    
    {{-- HEADER JUDUL HALAMAN --}}
    <div class="explore-header">
        <h2>Eksplorasi <span>Pengetahuan</span> Tanpa Batas</h2>
        <p>Temukan beragam buku pilihan yang dirancang untuk memperluas wawasan, menginspirasi, dan memperkaya pemikiran Anda.</p>
    </div>

    {{-- UTILITY SEARCH & FILTER BAR --}}
    <form method="GET" action="{{ route('buku.all') }}" class="utility-bar-form">
        <div class="search-box-wrapper">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="search" id="searchBook" placeholder="Cari berdasarkan judul atau penulis..." value="{{ request('search') }}">
        </div>
        
        <div class="filter-select-wrapper">
            <select name="kategori_id" id="filterCategory">
                <option value="">Semua Kategori</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- PERBAIKAN: Mengganti fa-filter menjadi fa-magnifying-glass sesuai mockup asli --}}
        <button type="submit" class="btn-search-submit">
            <i class="fa-solid fa-magnifying-glass"></i> Cari
        </button>
    </form>

    {{-- GRID PRODUK KATALOG UTAMA --}}
    <div class="books-product-grid">
        @forelse($buku as $item)
        <div class="product-card">
            {{-- PERBAIKAN: Membungkus cover dengan rute detail dinamis --}}
            <div class="product-cover-box">
                <a href="{{ route('buku.detail', $item->id) }}" style="width: 100%; height: 100%; display: block;">
                    <img src="{{ asset('images/covers/' . ($item->id % 5 + 1) . '.jpg') }}" alt="{{ $item->judul }}">
                </a>
            </div>
            
            <div class="product-info">
                <h4>{{ $item->judul }}</h4>
                <div class="product-author">{{ $item->penulis }}</div>
                <div class="product-stock">Tersedia: {{ $item->stok ?? 10 }}</div>
                
                <div class="product-rating">
                    <span>5.0</span>
                    <div>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>

                <div class="product-price">Rp {{ number_format($item->harga_nasional, 0, ',', '.') }}</div>
                
                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-card-add">Tambah ke Keranjang</button>
                </form>
            </div>
        </div>
        @empty
        <div style="grid-column: span 5; text-align: center; padding: 40px; color: #9aa3be;">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 32px; margin-bottom: 10px; opacity: 0.5;"></i>
            <p>Buku yang Anda cari tidak ditemukan.</p>
        </div>
        @endforelse
    </div>

</div>

@endsection
