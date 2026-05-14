<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kasir - Pesanan Online</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #007bff; }
        .btn-pos { background-color: #6c757d; color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; }
        .btn-pos:hover { background-color: #5a6268; }

        .alert-success { background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-weight: bold; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; font-weight: bold; }
        tr:hover { background-color: #f1f1f1; }

        .thumbnail { width: 80px; height: 80px; object-fit: cover; border: 1px solid #ccc; border-radius: 4px; transition: transform 0.2s; cursor: pointer; }
        .thumbnail:hover { transform: scale(1.1); }

        .btn-acc { background-color: #28a745; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-acc:hover { background-color: #218838; }
        .empty-state { text-align: center; padding: 30px; color: #777; font-style: italic; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Pesanan Online (Click & Collect)</h2>
            <a href="{{ route('kasir.pos') }}" class="btn-pos">Buka Mesin Kasir (Offline)</a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>No. Struk</th>
                    <th>Total Bayar</th>
                    <th>Bukti Transfer</th>
                    <th>Aksi Kasir</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksi as $item)
                <tr>
                    <td><strong>{{ $item->no_struk }}</strong></td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>

                    <td>
                        <a href="{{ asset('storage/' . $item->bukti_bayar) }}" target="_blank" title="Klik untuk memperbesar">
                            <img src="{{ asset('storage/' . $item->bukti_bayar) }}" alt="Bukti Transfer" class="thumbnail">
                        </a>
                    </td>

                    <td>
                        <form action="{{ route('kasir.acc', $item->id) }}" method="POST" onsubmit="return confirm('Apakah uang sudah masuk ke rekening? Stok buku akan terpotong secara otomatis jika Anda klik OK.')">
                            @csrf
                            <button type="submit" class="btn-acc">ACC & Serahkan Barang</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="empty-state">
                        Belum ada pesanan online baru yang menunggu konfirmasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
