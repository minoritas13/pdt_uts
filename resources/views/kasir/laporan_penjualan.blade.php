<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Cabang</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .kpi-board { display: flex; gap: 20px; margin-bottom: 30px; }
        .kpi-card { flex: 1; padding: 20px; border-radius: 8px; color: white; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8f9fa; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-actions">
        <h2 style="margin:0;">Laporan Penjualan Cabang</h2>
        <a href="{{ route('cabang.laporan.terlaris') }}" style="background: #17a2b8; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">Lihat Buku Terlaris (Best Seller)</a>
    </div>

    <form method="GET" action="{{ route('cabang.laporan.penjualan') }}" style="background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-radius: 8px;">
        <label>Dari: <input type="date" name="tgl_mulai" value="{{ $tgl_mulai }}"></label>
        <label style="margin-left: 10px;">Sampai: <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}"></label>
        <button type="submit" style="margin-left: 10px; background: #007bff; color: white; border: none; padding: 6px 15px; border-radius: 4px;">Filter</button>
    </form>

    <div class="kpi-board">
        <div class="kpi-card" style="background: #28a745;">
            <h3>Total Omzet Cabang</h3>
            <h2 style="margin:0;">Rp {{ number_format($total_omzet, 0, ',', '.') }}</h2>
            <p style="margin:5px 0 0 0;">Dari {{ $total_transaksi }} Transaksi Berhasil</p>
        </div>
        <div class="kpi-card" style="background: #6c757d;">
            <h3>Omzet Kasir Offline</h3>
            <h2 style="margin:0;">Rp {{ number_format($omzet_offline, 0, ',', '.') }}</h2>
        </div>
    </div>

    <h3>Rincian Transaksi</h3>
    <table>
        <tr>
            <th>Waktu</th>
            <th>No. Struk</th>
            <th>Metode Pembayaran</th>
            <th>Total Bayar</th>
        </tr>
        @forelse($transaksi as $item)
        <tr>
            <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
            <td><strong>{{ $item->no_struk }}</strong></td>
            <td>{{ $item->bukti_bayar == 'CASH' ? 'Tunai (Kasir)' : 'Transfer (Online)' }}</td>
            <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align: center;">Tidak ada data penjualan.</td></tr>
        @endforelse
    </table>
</div>

</body>
</html>
