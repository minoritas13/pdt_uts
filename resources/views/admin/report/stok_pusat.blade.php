<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Pusat</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .kpi-board { display: flex; gap: 20px; margin-bottom: 20px; }
        .kpi-card { flex: 1; padding: 15px; border-radius: 8px; color: white; text-align: center; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    </style>
</head>
<body>

<div class="container">
    <h2>Monitoring Stok Gudang Pusat</h2>

    <div class="kpi-board">
        <div class="kpi-card" style="background: #007bff;">
            <h3>Total Judul Buku</h3>
            <h2>{{ $total_judul }} Judul</h2>
        </div>
        <div class="kpi-card" style="background: #28a745;">
            <h3>Total Fisik Buku</h3>
            <h2>{{ number_format($total_stok_fisik, 0, ',', '.') }} Unit</h2>
        </div>
        <div class="kpi-card" style="background: {{ $stok_kritis > 0 ? '#dc3545' : '#17a2b8' }};">
            <h3>Peringatan Stok Kritis</h3>
            <h2>{{ $stok_kritis }} Buku < 10 Unit</h2>
        </div>
    </div>

    <table>
        <tr style="background: #f8f9fa;">
            <th>ID Buku</th>
            <th>Judul Buku</th>
            <th>Harga Nasional</th>
            <th>Sisa Stok Pusat</th>
            <th>Status</th>
        </tr>
        @forelse($stokPusat as $item)
        <tr>
            <td>#{{ $item->buku_id }}</td>
            <td><strong>{{ $item->buku->judul ?? 'Data Buku Dihapus' }}</strong></td>
            <td>Rp {{ number_format($item->buku->harga_nasional ?? 0, 0, ',', '.') }}</td>

            <td style="font-size: 18px; font-weight: bold; color: {{ $item->qty_tersedia < 10 ? 'red' : 'green' }};">
                {{ $item->qty_tersedia }}
            </td>

            <td>
                @if($item->qty_tersedia == 0)
                    <span style="color: red; font-weight:bold;">HABIS</span>
                @elseif($item->qty_tersedia < 10)
                    <span style="color: orange; font-weight:bold;">KRITIS</span>
                @else
                    <span style="color: green;">AMAN</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center; padding: 20px;">Belum ada data stok di gudang pusat.</td>
        </tr>
        @endforelse
    </table>
</div>

</body>
</html>
