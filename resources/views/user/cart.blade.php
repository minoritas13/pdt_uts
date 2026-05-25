@extends('layouts.user')

@section('title', 'Keranjang Saya — SPBT')

@push('styles')
<style>
    .cart-page-wrapper {
        padding: 40px 6% 80px;
        background-color: #ffffff;
    }

    .cart-title-area {
        margin-bottom: 24px;
    }

    .cart-title-area h2 {
        font-size: 22px;
        font-weight: 800;
        color: #112c7a;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .cart-title-area p {
        font-size: 13.5px;
        color: #6b7280;
        margin-top: 4px;
    }

    /* ─── DUA KOLOM LAYOUT (PERSIS MOCKUP) ─── */
    .cart-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 30px;
        align-items: start;
    }

    /* ─── SISI KIRI: LIST ITEM CARD ─── */
    .cart-items-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 24px;
        box-shadow: 0 4px 20px rgba(17, 44, 122, 0.02);
    }

    .cart-item-row {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .cart-item-row:last-child {
        padding-bottom: 0;
        border-bottom: none;
    }

    /* Custom Checkbox Bergaya Biru Sesuai Mockup */
    .custom-checkbox {
        width: 20px;
        height: 20px;
        cursor: pointer;
        accent-color: #0c73be;
    }

    .item-cover-box {
        width: 80px;
        height: 110px;
        background: #f3f4f6;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .item-cover-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex: 1;
    }

    .item-details h4 {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .item-author {
        font-size: 12px;
        color: #9aa3be;
        margin-bottom: 12px;
    }

    .item-price {
        font-size: 14.5px;
        font-weight: 800;
        color: #1e293b;
    }

    /* Pengatur Kuantitas +/- Kapsul Kuning */
    .quantity-control-area {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 16px;
    }

    .qty-picker {
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 6px;
        overflow: hidden;
    }

    .qty-btn {
        width: 24px;
        height: 24px;
        background: #f2b705;
        color: #fff;
        border: none;
        font-weight: 700;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-input {
        width: 36px;
        height: 24px;
        text-align: center;
        border: none;
        background: #f8fafc;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        outline: none;
    }

    /* Menghilangkan panah spinner default input number */
    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .btn-remove-item {
        background: none;
        border: none;
        color: #0c73be;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-remove-item:hover {
        color: #ef4444;
    }

    /* ─── SISI KANAN: CARD DETAIL PESANAN ─── */
    .summary-card {
        background: var(--white);
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px rgba(17, 44, 122, 0.03);
    }

    .summary-card h3 {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 20px;
    }

    .mini-items-container {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-bottom: 20px;
        max-height: 240px;
        overflow-y: auto;
    }

    .mini-item-row {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .mini-cover {
        width: 40px;
        height: 55px;
        background: #f3f4f6;
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }

    .mini-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .mini-details {
        flex: 1;
    }

    .mini-details h5 {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px;
    }

    .mini-details p {
        font-size: 11.5px;
        color: #9aa3be;
        margin-top: 2px;
    }

    .mini-price {
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
    }

    .divider-line {
        height: 1px;
        background: #e2e8f0;
        margin-bottom: 16px;
    }

    .grand-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .grand-total-row .label {
        font-size: 13.5px;
        font-weight: 600;
        color: #1e293b;
    }

    .grand-total-row .value {
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
    }

    .btn-checkout {
        width: 100%;
        padding: 12px;
        border-radius: 25px;
        background: var(--yellow);
        color: #112c7a;
        border: none;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-bottom: 10px;
    }

    .btn-checkout:hover { background: #e0aa04; }

    .btn-back-katalog {
        width: 100%;
        padding: 12px;
        border-radius: 25px;
        background: transparent;
        color: #112c7a;
        border: 1.5px solid #112c7a;
        text-decoration: none;
        font-size: 13.5px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.2s;
    }

    .btn-back-katalog:hover {
        background: rgba(17, 44, 122, 0.04);
    }

    /* ─── RESPONSIVE GRID ─── */
    @media (max-width: 991px) {
        .cart-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="cart-page-wrapper">
    
    <div class="cart-title-area">
        <h2><i class="fa-solid fa-cart-shopping"></i> Keranjang Saya</h2>
        <p>Terdapat {{ session('cart') ? count(session('cart')) : 0 }} item buku dalam keranjang anda</p>
    </div>

    <div class="cart-grid">
        
        {{-- SISI KIRI: DAFTAR BUKU --}}
        <div class="cart-items-list">
            @if(session('cart') && count(session('cart')) > 0)
                @foreach(session('cart') as $id => $details)
                <div class="cart-item-row" data-id="{{ $id }}">
                    <input type="checkbox" class="custom-checkbox" checked>
                    
                    <div class="item-cover-box">
                        <img src="{{ asset('images/covers/' . ($id % 5 + 1) . '.jpg') }}" alt="{{ $details['judul'] }}">
                    </div>

                    <div class="item-details">
                        <h4>{{ $details['judul'] }}</h4>
                        <div class="item-author">by {{ $details['penulis'] ?? 'Penulis SPBT' }}</div>
                        <div class="item-price">Rp {{ number_format($details['harga'], 0, ',', '.') }}</div>
                    </div>

                    <div class="quantity-control-area">
                        <div class="qty-picker">
                            <button type="button" class="qty-btn minus-btn" onclick="adjustQty(this, -1)">-</button>
                            <input type="number" value="{{ $details['quantity'] }}" min="1" 
                                   class="qty-input" data-harga="{{ $details['harga'] }}" data-id="{{ $id }}" readonly>
                            <button type="button" class="qty-btn plus-btn" onclick="adjustQty(this, 1)">+</button>
                        </div>

                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-remove-item">
                                <i class="fa-regular fa-trash-can"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <div style="text-align:center; padding: 40px 0; color: #9aa3be;">
                    <i class="fa-solid fa-basket-shopping" style="font-size: 36px; margin-bottom: 12px; opacity:0.5;"></i>
                    <p>Keranjang belanja Anda masih kosong.</p>
                </div>
            @endif
        </div>

        {{-- SISI KANAN: PANEL RINGKASAN TOTAL --}}
        <div class="summary-card">
            <h3>Detail Pesanan</h3>

            <div class="mini-items-container">
                @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                    <div class="mini-item-row" data-mini-id="{{ $id }}">
                        <div class="mini-cover">
                            <img src="{{ asset('images/covers/' . ($id % 5 + 1) . '.jpg') }}" alt="{{ $details['judul'] }}">
                        </div>
                        <div class="mini-details">
                            <h5>{{ $details['judul'] }}</h5>
                            <p>Jumlah: <span class="mini-qty-label">{{ $details['quantity'] }}</span></p>
                        </div>
                        <div class="mini-price subtotal-cell">
                            Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>

            <div class="divider-line"></div>

            @php 
                $total = 0;
                if(session('cart')) {
                    foreach(session('cart') as $details) {
                        $total += $details['harga'] * $details['quantity'];
                    }
                }
            @endphp
            <div class="grand-total-row">
                <span class="label">Total</span>
                <span class="value">Rp <span id="grand-total">{{ number_format($total, 0, ',', '.') }}</span></span>
            </div>

            <form action="{{ route('checkout.proses') }}" method="POST">
                @csrf
                <button type="submit" class="btn-checkout">
                    <i class="fa-solid fa-cart-arrow-down"></i> Lanjut Check Out
                </button>
            </form>

            <a href="{{ route('katalog.index') }}" class="btn-back-katalog">
                <i class="fa-solid fa-rotate-left"></i> Lanjut Belanja
            </a>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    // Format angka ke format Rupiah
    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }

    // Fungsi klik tombol plus/minus kuantitas
    function adjustQty(button, amount) {
        const picker = button.closest('.qty-picker');
        const input = picker.querySelector('.qty-input');
        let currentVal = parseInt(input.value) || 1;
        
        currentVal += amount;
        if (currentVal < 1) currentVal = 1;
        
        input.value = currentVal;
        
        // Trigger fungsi update harga
        calculateRowPrice(input);
    }

    // Hitung perubahan harga baris & update panel kanan
    function calculateRowPrice(input) {
        const harga = parseInt(input.dataset.harga);
        const qty = parseInt(input.value) || 1;
        const id = input.dataset.id;

        // 1. Update teks Qty di panel ringkasan kanan
        const miniRow = document.querySelector(`[data-mini-id="${id}"]`);
        if (miniRow) {
            miniRow.querySelector('.mini-qty-label').textContent = qty;
            // 2. Update subtotal baris di panel kanan
            miniRow.querySelector('.subtotal-cell').textContent = 'Rp ' + formatRupiah(harga * qty);
        }

        // 3. Hitung ulang Grand Total keseluruhan
        updateGrandTotal();
    }

    // Hitung ulang keseluruhan isi keranjang
    function updateGrandTotal() {
        let grandTotal = 0;

        document.querySelectorAll('.qty-input').forEach(input => {
            const harga = parseInt(input.dataset.harga);
            const qty = parseInt(input.value) || 1;
            grandTotal += harga * qty;
        });

        document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
    }
</script>
@endpush
