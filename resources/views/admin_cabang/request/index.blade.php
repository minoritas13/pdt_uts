<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Request Stok ke Pusat</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-box { background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #ddd; }
        input, select, textarea { width: 100%; padding: 10px; margin-top: 5px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>

<div class="container">
    <h2>Buat Permintaan Stok Baru (Restock)</h2>

    @if(session('success')) <div style="color: green; margin-bottom: 15px; font-weight: bold;">{{ session('success') }}</div> @endif

    <div class="form-box">
        <form action="{{ route('cabang.request.store') }}" method="POST">
            @csrf
            <label>Pilih Judul Buku (Katalog Pusat):</label>
            <select name="buku_id" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($buku as $item)
                    <option value="{{ $item->id }}">{{ $item->judul }}</option>
                @endforeach
            </select>

            <label>Jumlah Permintaan (Qty):</label>
            <input type="number" name="qty" min="1" required>

            <label>Catatan Opsional:</label>
            <textarea name="catatan_cabang" rows="2" placeholder="Contoh: Tolong segera dikirim karena stok rak habis..."></textarea>

            <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer;">Kirim Request ke Pusat</button>
        </form>
    </div>

    <h3>Riwayat Permintaan Cabang</h3>
    <table>
        <tr style="background: #eee;">
            <th>Tanggal Request</th>
            <th>Judul Buku</th>
            <th>Qty</th>
            <th>Catatan</th>
            <th>Status</th>
        </tr>
        @forelse($riwayat_request as $item)
        <tr>
            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
            <td><strong>{{ $item->buku->judul ?? 'N/A' }}</strong></td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->catatan_cabang ?? '-' }}</td>
            <td>
                @if($item->status == 'PENDING') <span style="color: orange; font-weight: bold;">Menunggu Pusat</span>
                @elseif($item->status == 'DIKIRIM') <span style="color: green; font-weight: bold;">Di Jalan (Cek Penerimaan)</span>
                @else <span style="color: red; font-weight: bold;">Ditolak Pusat</span>
                @endif
            </td>
        </tr>
        @empty
        <tr><td colspan="5" style="text-align: center;">Belum ada riwayat permintaan.</td></tr>
        @endforelse
    </table>
</div>

</body>
</html>
