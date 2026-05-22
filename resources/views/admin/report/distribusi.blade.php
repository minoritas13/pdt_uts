<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Histori Distribusi Pusat</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8f9fa; }
        .filter-box { background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-radius: 8px; display: flex; align-items: center; justify-content: space-between;}
    </style>
</head>
<body>

<div class="container">
    <h2>Histori Distribusi Barang (Surat Jalan)</h2>

    <div class="filter-box">
        <form method="GET" action="{{ route('pusat.laporan.distribusi') }}">
            <label>Dari: <input type="date" name="tgl_mulai" value="{{ $tgl_mulai }}"></label>
            <label style="margin-left: 10px;">Sampai: <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}"></label>
            <button type="submit" style="margin-left: 10px; background: #007bff; color: white; border: none; padding: 6px 15px; border-radius: 4px;">Filter Laporan</button>
        </form>
        <div><strong>Total Buku Dikirim: <span style="color: #28a745;">{{ number_format($total_buku_dikirim, 0, ',', '.') }} Unit</span></strong></div>
    </div>

    <table>
        <tr>
            <th>Waktu Kirim</th>
            <th>Nomor Surat Jalan</th>
            <th>Judul Buku</th>
            <th>Jumlah (Qty)</th>
        </tr>
        @forelse($distribusi as $item)
        <tr>
            <td>{{ date('d/m/Y H:i', strtotime($item->waktu)) }}</td>
            <td><strong>{{ $item->keterangan }}</strong></td>
            <td>{{ $item->buku->judul ?? 'Buku Dihapus' }}</td>
            <td>{{ $item->qty }} Unit</td>
        </tr>
        @empty
        <tr><td colspan="4" style="text-align: center;">Tidak ada data pengiriman pada rentang tanggal tersebut.</td></tr>
        @endforelse
    </table>
</div>

</body>
</html>
