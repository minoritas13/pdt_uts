<h2>Kirim Barang ke Cabang</h2>

@if(session('success')) <div style="color: green; margin-bottom: 15px;">{{ session('success') }}</div> @endif
@if(session('error')) <div style="color: red; margin-bottom: 15px;">{{ session('error') }}</div> @endif

<form action="{{ route('pusat.distribusi.kirim') }}" method="POST" style="margin-bottom: 30px; border: 1px solid #ccc; padding: 15px; width: 400px; background: #f9f9f9;">
    @csrf
    <label><strong>Pilih Buku:</strong></label><br>
    <select name="buku_id" required style="width: 100%; padding: 8px; margin-top: 5px;">
        <option value="">-- Pilih Buku --</option>
        @foreach($buku as $item)
            <option value="{{ $item->id }}">{{ $item->judul }} (Stok Pusat: {{ $item->stok }})</option>
        @endforeach
    </select><br><br>

    <label><strong>Jumlah Kirim (Qty):</strong></label><br>
    <input type="number" name="qty" min="1" required style="width: 100%; padding: 8px; margin-top: 5px;"><br><br>

    <button type="submit" style="background: blue; color: white; padding: 10px 15px; border: none; cursor: pointer;">
        Kirim Barang ke Ekspedisi
    </button>
</form>

<h3>Catatan Pengiriman (Mutasi Keluar)</h3>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
    <thead style="background-color: #f4f4f4;">
        <tr>
            <th>No. Referensi (SJ)</th>
            <th>ID Buku</th>
            <th>Qty Keluar</th>
            <th>Waktu Kirim</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengiriman as $item)
        <tr>
            <td><strong>{{ $item->keterangan }}</strong></td>
            <td>Buku ID #{{ $item->buku_id }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->waktu }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
