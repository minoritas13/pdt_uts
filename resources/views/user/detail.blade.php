@extends('layouts.user')

@section('title', $bukuUtama->judul . ' — SPBT')

@push('styles')
<style>
    .detail-page-container {
        padding: 50px 6% 80px;
        background-color: #ffffff;
    }

    /* ─── ATAS: MAIN DETAIL GRID (2 KOLOM) ─── */
    .main-detail-grid {
        display: grid;
        grid-template-columns: 320px 1fr;
        gap: 40px;
        margin-bottom: 50px;
    }

    .detail-cover-wrapper {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 400px;
    }

    .detail-cover-wrapper img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        box-shadow: 5px 5px 15px rgba(0,0,0,0.15);
        border-radius: 4px;
    }

    .detail-info-side {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .detail-info-side h1 {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .detail-info-side .author {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .detail-info-side .stock {
        font-size: 13.5px;
        font-weight: 600;
        color: #4b5563;
        margin-bottom: 16px;
    }

    .detail-info-side .price {
        font-size: 24px;
        font-weight: 800;
        color: #112c7a;
        margin-bottom: 24px;
    }

    /* Form Dropdown Format */
    .format-selector {
        margin-bottom: 28px;
        max-width: 200px;
    }

    .format-selector label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #9aa3be;
        margin-bottom: 6px;
    }

    .format-selector select {
        width: 100%;
        padding: 10px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-family: inherit;
        font-size: 13.5px;
        background: #ffffff;
        outline: none;
        cursor: pointer;
    }

    .btn-add-to-cart {
        padding: 12px 30px;
        border-radius: 25px;
        background: #f2b705; /* Kuning sesuai foto */
        color: #112c7a;
        border: none;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(242, 183, 5, 0.2);
        transition: background 0.2s;
        align-self: flex-start;
    }

    .btn-add-to-cart:hover { background: #e0aa04; }

    /* ─── TENGAH: TABS & SINOPSIS ─── */
    .tabs-navigation {
        display: flex;
        gap: 24px;
        border-bottom: 1px solid #e2e8f0;
        margin-bottom: 20px;
    }

    .tab-link {
        font-size: 15px;
        font-weight: 700;
        color: #9aa3be;
        padding-bottom: 10px;
        text-decoration: none;
        cursor: pointer;
        border-bottom: 2px solid transparent;
    }

    .tab-link.active {
        color: #112c7a;
        border-bottom-color: #112c7a;
    }

    .tab-content-text {
        font-size: 14.5px;
        color: #4b5563;
        line-height: 1.7;
        margin-bottom: 60px;
    }

    /* ─── BAWAH: REKOMENDASI GRID ─── */
    .recommendation-title {
        font-size: 18px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 24px;
    }

    .books-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 20px;
    }

    .book-card {
        background: #ffffff;
        transition: transform 0.2s;
        text-decoration: none;
        color: inherit;
    }

    .book-card:hover { transform: translateY(-4px); }

    .cover-wrapper {
        background: #f3f4f6;
        border-radius: 12px;
        height: 240px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .cover-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .book-info h4 {
        font-size: 13.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .book-author {
        font-size: 11.5px;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .rating-row {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .rating-row i { color: #f2b705; }

    .book-price {
        font-size: 13.5px;
        font-weight: 800;
        color: #112c7a;
    }

    @media (max-width: 768px) {
        .main-detail-grid { grid-template-columns: 1fr; }
        .books-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@section('content')

<div class="detail-page-container">
    
    {{-- BAGIAN ATAS: INFO UTAMA BUKU --}}
    <div class="main-detail-grid">
        <div class="detail-cover-wrapper">
            <img src="{{ asset('images/covers/' . ($bukuUtama->id % 5 + 1) . '.jpg') }}" alt="{{ $bukuUtama->judul }}">
        </div>

        <div class="detail-info-side">
            <h1>{{ $bukuUtama->judul }}</h1>
            <div class="author">by {{ $bukuUtama->penulis }}</div>
            <div class="stock">Tersedia: {{ $bukuUtama->stok ?? 10 }}</div>
            <div class="price">Rp {{ number_format($bukuUtama->harga_nasional, 0, ',', '.') }}</div>

            <div class="format-selector">
                <label>Format</label>
                <select>
                    <option value="Hardcover">Hardcover</option>
                    <option value="Softcover">Softcover / Paperback</option>
                </select>
            </div>

            <form action="{{ route('cart.add', $bukuUtama->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn-add-to-cart">
                    <i class="fa-solid fa-cart-plus"></i> Tambah Keranjang
                </button>
            </form>
        </div>
    </div>

    {{-- BAGIAN TENGAH: TABS & KONTEN TEXT SINOPSIS --}}
    <div class="tabs-navigation">
        <div class="tab-link active" onclick="switchTab(this, 'sinopsis')">Sinopsis</div>
        <div class="tab-link" onclick="switchTab(this, 'detail')">Detail Buku</div>
    </div>

    <div class="tab-content-text" id="tabContent">
        {{-- Sinopsis default (jika field belum ada di DB kamu, teks statis dari gambar ini akan muncul sebagai fallback) --}}
        Buku "{{ $bukuUtama->judul }}" menampilkan keindahan karya seni yang dibuat dari bahan alam seperti jaspe, alabastro, dan ametis. Melalui koleksi akademik dari Arthur Gilbert, buku ini memperlihatkan keahlian para pengrajin Eropa dalam menciptakan benda-benda mewah penuh detail dan makna sejarah. Setiap halaman menghadirkan harmoni antara keindahan alam dan kecekatan tangan manusia dalam seni batu yang abadi.
    </div>

    {{-- BAGIAN BAWAH: GRID BUKU SERUPA REKOMENDASI --}}
    <h3 class="recommendation-title">Buku Serupa yang Mungkin Anda Suka</h3>
    <div class="books-grid">
        @foreach($bukuSerupa as $item)
        <a href="{{ route('buku.detail', $item->id) }}" class="book-card">
            <div class="cover-wrapper">
                <img src="{{ asset('images/covers/' . ($item->id % 5 + 1) . '.jpg') }}" alt="{{ $item->judul }}">
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
            </div>
        </a>
        @endforeach
    </div>

</div>

@endsection

@push('scripts')
<script>
    // Interaktivitas Tab Navigation (Sinopsis & Detail Buku)
    function switchTab(element, type) {
        document.querySelectorAll('.tab-link').forEach(el => el.classList.remove('active'));
        element.classList.add('active');

        const contentBox = document.getElementById('tabContent');
        if (type === 'sinopsis') {
            contentBox.innerHTML = `Buku "${{ json_encode($bukuUtama->judul) }}" menampilkan keindahan karya seni yang dibuat dari bahan alam seperti jaspe, alabastro, dan ametis. Melalui koleksi akademik dari Arthur Gilbert, buku ini memperlihatkan keahlian para pengrajin Eropa dalam menciptakan benda-benda mewah penuh detail dan makna sejarah. Setiap halaman menghadirkan harmoni antara keindahan alam dan kecekatan tangan manusia dalam seni batu yang abadi.`;
        } else {
            contentBox.innerHTML = `
                <table style="width:100%; max-width:400px; border-collapse:collapse; font-size:14px;">
                    <tr style="border-bottom: 1px solid #edf2f7;"><td style="padding:8px 0; font-weight:600; color:#718096;">ISBN</td><td style="padding:8px 0; color:#2d3748;">{{ $bukuUtama->isbn }}</td></tr>
                    <tr style="border-bottom: 1px solid #edf2f7;"><td style="padding:8px 0; font-weight:600; color:#718096;">Penerbit</td><td style="padding:8px 0; color:#2d3748;">{{ $bukuUtama->penerbit->nama_penerbit ?? 'N/A' }}</td></tr>
                    <tr style="border-bottom: 1px solid #edf2f7;"><td style="padding:8px 0; font-weight:600; color:#718096;">Kategori</td><td style="padding:8px 0; color:#2d3748;">{{ $bukuUtama->kategori->nama_kategori ?? 'N/A' }}</td></tr>
                </table>
            `;
        }
    }
</script>
@endpush
