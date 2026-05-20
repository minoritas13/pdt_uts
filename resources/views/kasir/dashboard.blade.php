<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mesin Kasir (POS)</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; margin: 0; padding: 20px; color: #333; }
        .header { display: flex; justify-content: space-between; margin-bottom: 20px; }
        .wrapper { display: flex; gap: 20px; }
        
        /* Bagian Kiri: Katalog */
        .katalog-section { flex: 6; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); height: 80vh; overflow-y: auto; }
        
        /* Bagian Kanan: Keranjang/Struk */
        .cart-section { flex: 4; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; flex-direction: column; height: 80vh; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8f9fa; }
        
        .btn-add { background: #28a745; color: white; border: none; padding: 6px 12px; cursor: pointer; border-radius: 4px; }
        .btn-remove { background: #dc3545; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; font-size: 12px; }
        
        .cart-container { flex-grow: 1; overflow-y: auto; }
        .total-box { background: #e9ecef; padding: 15px; text-align: right; font-size: 24px; font-weight: bold; border-radius: 4px; margin-top: 10px; margin-bottom: 15px; }
        
        .btn-bayar { background: #007bff; color: white; width: 100%; padding: 15px; border: none; font-size: 18px; font-weight: bold; cursor: pointer; border-radius: 4px; }
        .btn-bayar:hover { background: #0056b3; }
        
        .qty-input { width: 50px; padding: 5px; text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Mesin Kasir - Transaksi Langsung</h2>
        <a href="{{ route('kasir.online') }}" style="background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">Lihat Pesanan Online</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 4px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 4px;">{{ session('error') }}</div>
    @endif

    <div class="wrapper">
        <div class="katalog-section">
            <h3>Daftar Buku Tersedia</h3>
            <table>
                <thead>
                    <tr>
                        <th>Judul Buku</th>
                        <th>Stok Rak</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stokLokal as $item)
                    <tr>
                        <td>{{ $item->buku->judul ?? 'N/A' }}</td>
                        <td>{{ $item->qty_tersedia }}</td>
                        <td>Rp {{ number_format($item->buku->harga_nasional ?? 0, 0, ',', '.') }}</td>
                        <td>
                            <button type="button" class="btn-add" 
                                onclick="addToCart({{ $item->buku_id }}, '{{ addslashes($item->buku->judul) }}', {{ $item->buku->harga_nasional }}, {{ $item->qty_tersedia }})">
                                Tambah
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center;">Stok rak kosong! Mintalah distribusi dari pusat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="cart-section">
            <h3>Struk Transaksi</h3>
            
            <form action="{{ route('kasir.pos.proses') }}" method="POST" id="form-bayar" style="display: flex; flex-direction: column; height: 100%;">
                @csrf
                
                <div class="cart-container">
                    <table id="cart-table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody id="cart-body">
                            </tbody>
                    </table>
                </div>

                <div class="total-box">
                    Total: Rp <span id="grand-total">0</span>
                </div>

                <button type="submit" class="btn-bayar" id="btn-submit" disabled>Terima Pembayaran</button>
            </form>
        </div>
    </div>

    <script>
        let cart = {}; // Object untuk menyimpan keranjang di memori browser

        // Format angka ke mata uang
        const formatRupiah = (angka) => new Intl.NumberFormat('id-ID').format(angka);

        function addToCart(id, judul, harga, maxStok) {
            // Jika barang sudah ada di keranjang, tambah qty-nya
            if (cart[id]) {
                if (cart[id].qty < maxStok) {
                    cart[id].qty++;
                } else {
                    alert('Maksimal stok tercapai!');
                }
            } else {
                // Jika belum ada, buat objek baru
                cart[id] = { judul: judul, harga: harga, qty: 1, maxStok: maxStok };
            }
            renderCart();
        }

        function ubahQty(id, value) {
            let newVal = parseInt(value);
            if (newVal > cart[id].maxStok) {
                alert('Maksimal stok yang tersedia adalah ' + cart[id].maxStok);
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

                // Buat baris tabel (TR) dan SELIPKAN tag <input type="hidden"> 
                // agar dikirim ke backend saat form disubmit!
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>
                        ${item.judul}
                        <input type="hidden" name="buku_id[]" value="${id}">
                    </td>
                    <td>Rp ${formatRupiah(item.harga)}</td>
                    <td>
                        <input type="number" name="qty[]" value="${item.qty}" min="1" max="${item.maxStok}" 
                            class="qty-input" onchange="ubahQty(${id}, this.value)">
                    </td>
                    <td>
                        <button type="button" class="btn-remove" onclick="hapusDariCart(${id})">X</button>
                    </td>
                `;
                tbody.appendChild(tr);
            }

            // Update Teks Total
            document.getElementById('grand-total').innerText = formatRupiah(grandTotal);

            // Aktifkan / Matikan Tombol Bayar
            const btnSubmit = document.getElementById('btn-submit');
            if (itemCount > 0) {
                btnSubmit.disabled = false;
                btnSubmit.style.background = '#007bff';
            } else {
                btnSubmit.disabled = true;
                btnSubmit.style.background = '#ccc';
            }
        }
    </script>
</body>
</html>