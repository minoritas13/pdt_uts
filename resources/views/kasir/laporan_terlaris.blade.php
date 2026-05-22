<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Top 10 Buku Terlaris</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8f9fa; }
    </style>
</head>
<body>

<div class="container">
    <div class="header-actions">
        <h2 style="margin:0;">Top 10 Buku Terlaris (Best Seller)</h2>
        <a href="{{ route('cabang.laporan.penjualan') }}" style="background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">Kembali ke Laporan Omzet</a>
    </div>

    <form method="GET" action="{{ route('cabang.laporan.terlaris') }}" style="background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-radius: 8px;">
        <label>Dari: <input type="date" name="tgl_mulai" value="{{ $tgl_mulai }}"></label>
        <label style="margin-left: 10px;">Sampai: <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}"></label>
        <button type="submit" style="margin-left: 10px; background: #007bff; color: white; border: none; padding: 6px 15px; border-radius: 4px;">Filter</button>
    </form>

    <table>
        <tr>
            <th>Peringkat</th>
            <th>Judul Buku</th>
            <th>Jumlah Terjual (Qty)</th>
            <th>Total Pendapatan Buku</th>
        </tr>
        @forelse($buku_terlaris as $index => $item)
        <tr>
            <td><h3 style="margin:0; color: #007bff;">#{{ $index + 1 }}</h3></td>
            <td><strong>{{ $item->buku->judul ?? 'N/A' }}</strong></td>
            <td style="color: #28a745; font-weight: bold;">{{ $item->total_qty }} Unit</td>
            <td>Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align: center;">Belum ada data penjualan untuk dianalisis.</td></tr>
        @endforelse
    </table>
</div>

</body>
</html>
