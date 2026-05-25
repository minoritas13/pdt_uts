@extends('layouts.kasir')

@section('title', 'Mesin Kasir (POS) — SPBT Admin')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }
    .page-header h1 { font-size: 22px; font-weight: 800; color: var(--gray-800); }
    .page-header p  { font-size: 13.5px; color: var(--gray-400); margin-top: 2px; }

    .btn-link-nav {
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        border: 1.5px solid var(--gray-200);
        background: var(--white);
        color: var(--gray-600);
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-link-nav:hover { border-color: var(--navy); color: var(--navy); }

    /* ─── WORKSPACE SPLIT LAYOUT ─── */
    .pos-layout-wrapper {
        display: grid;
        grid-template-columns: 1fr 420px;
        gap: 24px;
        flex: 1;
        align-items: start;
    }

    .panel-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.02);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        height: calc(100vh - 190px);
    }

    .panel-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--gray-100);
        font-size: 15px;
        font-weight: 700;
        color: var(--gray-800);
    }

    .panel-body-scroll {
        flex: 1;
        overflow-y: auto;
        padding: 0;
    }

    /* ─── COMPONENT TABLE STYLE ─── */
    table { width: 100%; border-collapse: collapse; }
    th {
        padding: 12px 24px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-100);
        position: sticky; top: 0; z-index: 10;
    }
    td {
        padding: 14px 24px;
        font-size: 13.5px;
        color: var(--gray-800);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--gray-50); }

    .book-title { font-weight: 700; color: var(--gray-800); }
    .stock-badge { font-weight: 600; color: var(--gray-600); }
    .price-text { font-weight: 600; color: var(--gray-800); }

    /* ─── CONTROLLER ACTION BUTTONS ─── */
    .btn-action-add {
        padding: 6px 14px;
        background: var(--navy);
        color: var(--white);
        border: none;
        border-radius: 30px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.15s;
    }
    .btn-action-add:hover { background: var(--light-blue); }

    .btn-action-remove {
        background: none;
        border: none;
        color: var(--red);
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-action-remove:hover { color: #b91c1c; }

    /* Input Kuantitas Mini Capsule */
    .qty-capsule-input {
        width: 54px;
        padding: 6px 10px;
        border-radius: 20px;
        border: 1px solid var(--gray-200);
        text-align: center;
        font-family: inherit;
        font-size: 13px;
        font-weight: 600;
        outline: none;
    }
    .qty-capsule-input:focus { border-color: #0c73be; }

    /* ─── RECEIPT BOX CHECKOUT ─── */
    .total-summary-container {
        padding: 24px;
        background: var(--gray-50);
        border-top: 1px solid var(--gray-100);
    }
    .grand-total-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 20px;
        font-weight: 800;
        color: var(--gray-800);
        margin-bottom: 16px;
    }
    .grand-total-box span { color: #15803d; }

    .btn-trigger-pay {
        width: 100%;
        padding: 14px;
        border: none;
        border-radius: 30px;
        font-family: inherit;
        font-size: 14.5px;
        font-weight: 700;
        color: var(--white);
        cursor: pointer;
        transition: background 0.2s;
    }

    /* ─── SYSTEM ALERTS ─── */
    .toast-alert {
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13.5px;
        font-weight: 600;
    }
    .toast-alert.success { background: var(--green-bg); color: #15803d; }
    .toast-alert.danger { background: var(--red-bg); color: #b91c1c; }
    .empty-message { text-align: center; padding: 40px; color: var(--gray-400); font-size: 13.5px; }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1>Mesin Kasir (POS)</h1>
        <p>Pencatatan transaksi penjualan buku offline/langsung di gerai toko cabang.</p>
    </div>
    <a href="{{ route('kasir.online') }}" class="btn-link-nav">Lihat Pesanan Online</a>
</div>

@if(session('success'))
    <div class="toast-alert success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="toast-alert danger">{{ session('error') }}</div>
@endif

<div class="pos-layout-wrapper">
    
    {{-- SISI KIRI: KATALOG STOK RAK LOKAL --}}
    <div class="panel-card">
        <div class="panel-header">Daftar Buku Tersedia (Stok Rak)</div>
        <div class="panel-body-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th style="width: 15%;">Stok Rak</th>
                        <th style="width: 25%;">Harga</th>
                        <th style="width: 15%; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokLokal as $item)
                    <tr>
                        <td><span class="book-title">{{ $item->buku->judul ?? 'N/A' }}</span></td>
                        <td><span class="stock-badge">{{ $item->qty_tersedia }} Unit</span></td>
                        <td><span class="price-text">Rp {{ number_format($item->buku->harga_nasional ?? 0, 0, ',', '.') }}</span></td>
                        <td style="text-align: right;">
                            <button type="button" class="btn-action-add" 
                                onclick="addToCart({{ $item->buku_id }}, '{{ addslashes($item->buku->judul) }}', {{ $item->buku->harga_nasional }}, {{ $item->qty_tersedia }})">
                                Tambah
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-message">Stok rak kosong! Mintalah distribusi dari pusat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- SISI KANAN: STRUK CHECKOUT KERANJANG --}}
    <div class="panel-card">
        <div class="panel-header">Struk Transaksi Baru</div>
        
        <form action="{{ route('kasir.pos.proses') }}" method="POST" id="form-bayar" style="display: flex; flex-direction: column; height: 100%;">
            @csrf
            
            <div class="panel-body-scroll">
                <table id="cart-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th style="width: 25%;">Harga</th>
                            <th style="width: 20%;">Qty</th>
                            <th style="width: 12%; text-align: center;"><i class="fa-regular fa-trash-can"></i></th>
                        </tr>
                    </thead>
                    <tbody id="cart-body">
                        </tbody>
                </table>
            </div>

            <div class="total-summary-container">
                <div class="grand-total-box">
                    <div>Total Tagihan</div>
                    <div>Rp <span id="grand-total">0</span></div>
                </div>

                <button type="submit" class="btn-trigger-pay" id="btn-submit" disabled>Terima Pembayaran</button>
            </div>
        </form>
    </div>

</div>

@endsection

@push('scripts')
<script>
    let cart = {}; 

    const formatRupiah = (angka) => new Intl.NumberFormat('id-ID').format(angka);

    function addToCart(id, judul, harga, maxStok) {
        if (cart[id]) {
            if (cart[id].qty < maxStok) {
                cart[id].qty++;
            } else {
                alert('Maksimal stok rak cabang telah tercapai!');
            }
        } else {
            cart[id] = { judul: judul, harga: harga, qty: 1, maxStok: maxStok };
        }
        renderCart();
    }

    function ubahQty(id, value) {
        let newVal = parseInt(value);
        if (newVal > cart[id].maxStok) {
            alert('Maksimal stok yang tersedia di rak adalah ' + cart[id].maxStok);
            cart[id].qty = cart[id].maxStok;
        } else if (newVal < 1 || isNaN(newVal)) {
            cart[id].qty = 1;
        } else {
            cart[id].qty = newVal;
        }
        renderCart();
    }

    function hapusDariCart(id) {
        delete cart[id];
        renderCart();
    }

    function renderCart() {
        const tbody = document.getElementById('cart-body');
        tbody.innerHTML = '';
        
        let grandTotal = 0;
        let itemCount = 0;

        for (let id in cart) {
            const item = cart[id];
            const subtotal = item.harga * item.qty;
            grandTotal += subtotal;
            itemCount++;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <span style="font-weight:600; font-size:13px; color:var(--gray-800)">${item.judul}</span>
                    <input type="hidden" name="buku_id[]" value="${id}">
                </td>
                <td><span style="font-weight:500; font-size:13px; color:var(--gray-600)">Rp ${formatRupiah(item.harga)}</span></td>
                <td>
                    <input type="number" name="qty[]" value="${item.qty}" min="1" max="${item.maxStok}" 
                        class="qty-capsule-input" onchange="ubahQty(${id}, this.value)">
                </td>
                <td style="text-align: center;">
                    <button type="button" class="btn-action-remove" onclick="hapusDariCart(${id})">
                         <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="margin:0 auto;"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        }

        document.getElementById('grand-total').innerText = formatRupiah(grandTotal);

        const btnSubmit = document.getElementById('btn-submit');
        if (itemCount > 0) {
            btnSubmit.disabled = false;
            btnSubmit.style.background = '#112c7a';
        } else {
            btnSubmit.disabled = true;
            btnSubmit.style.background = '#cbd5e1';
        }
    }
</script>
@endpush
