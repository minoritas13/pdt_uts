<a href="{{ route('katalog.index') }}">back</a>
<h2>Keranjang Belanja</h2>
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                @php $total += $details['harga'] * $details['quantity'] @endphp
                <tr>
                    <td>{{ $details['judul'] }}</td>
                    <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                    <td>
                        <input type="number" value="{{ $details['quantity'] }}" min="1" style="width: 50px;"
                            class="qty-input" data-harga="{{ $details['harga'] }}">
                    </td>
                    {{-- ini bagian delete --}}
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                    {{-- Tambahkan class subtotal-cell --}}
                    <td class="subtotal-cell">
                        Rp {{ number_format($details['harga'] * $details['quantity'], 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<h3>Total: Rp <span id="grand-total">{{ number_format($total, 0, ',', '.') }}</span></h3>

<form action="{{ route('checkout.proses') }}" method="POST">
    @csrf
    <button type="submit" style="background: green; color: white; padding: 10px 20px;">Lanjut ke Pembayaran</button>
</form>


<script>
    // Format angka ke format Rupiah (1.000.000)
    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID');
    }

    // Hitung ulang grand total dari semua subtotal
    function updateGrandTotal() {
        let grandTotal = 0;

        document.querySelectorAll('.qty-input').forEach(input => {
            const harga = parseInt(input.dataset.harga);
            const qty = parseInt(input.value) || 1;
            grandTotal += harga * qty;
        });

        document.getElementById('grand-total').textContent = formatRupiah(grandTotal);
    }

    // Jalankan saat quantity berubah
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('input', function() {
            const harga = parseInt(this.dataset.harga);
            const qty = parseInt(this.value) || 1;

            // Update subtotal di kolom yang sama
            const subtotalCell = this.closest('tr').querySelector('.subtotal-cell');
            subtotalCell.textContent = 'Rp ' + formatRupiah(harga * qty);

            // Update grand total
            updateGrandTotal();
        });
    });
</script>
