<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Global</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .kpi-board { display: flex; gap: 20px; margin-bottom: 30px; }
        .kpi-card { flex: 1; padding: 20px; border-radius: 8px; color: white; text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8f9fa; }
    </style>
</head>
<body>

<div class="container">
    <h2>Laporan Omzet Keseluruhan (Integrasi Cabang)</h2>

    <form method="GET" action="{{ route('pusat.laporan.penjualan') }}" style="background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-radius: 8px;">
        <label>Dari: <input type="date" name="tgl_mulai" value="{{ $tgl_mulai }}"></label>
        <label style="margin-left: 10px;">Sampai: <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}"></label>
        <button type="submit" style="margin-left: 10px; background: #007bff; color: white; border: none; padding: 6px 15px; border-radius: 4px;">Filter Laporan</button>
    </form>

    <div class="kpi-board">
        <div class="kpi-card" style="background: #28a745;">
            <h3>Total Omzet Keseluruhan</h3>
            <h2 style="margin:0;">Rp {{ number_format($total_omzet, 0, ',', '.') }}</h2>
            <p style="margin:5px 0 0 0;">Dari {{ $total_transaksi }} Transaksi</p>
        </div>
        <div class="kpi-card" style="background: #17a2b8;">
            <h3>Omzet POS (Kasir Offline)</h3>
            <h2 style="margin:0;">Rp {{ number_format($omzet_offline, 0, ',', '.') }}</h2>
        </div>
        <div class="kpi-card" style="background: #6c757d;">
            <h3>Omzet Pelanggan Online</h3>
            <h2 style="margin:0;">Rp {{ number_format($omzet_online, 0, ',', '.') }}</h2>
        </div>
    </div>

    <h3>Rincian Transaksi Cabang</h3>
    <table>
        <tr>
            <th>Waktu Transaksi</th>
            <th>No. Struk</th>
            <th>Tipe Pembelian</th>
            <th>Total Bayar</th>
        </tr>
        @forelse($transaksi as $trx)
        <tr>
            <td>{{ date('d/m/Y H:i', strtotime($trx->created_at)) }}</td>
            <td><strong>{{ $trx->no_struk }}</strong></td>
            <td>{{ $trx->tipe_pesanan }}</td>
            <td>Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align: center;">Belum ada data penjualan.</td></tr>
        @endforelse
    </table>
</div>

</body>
</html>
