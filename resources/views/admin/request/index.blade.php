<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Persetujuan Request Cabang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f6;
            padding: 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }

        th {
            background: #f8f9fa;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-terima {
            background: #28a745;
            color: white;
        }

        .btn-terima:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-tolak {
            background: #dc3545;
            color: white;
            margin-left: 5px;
        }

        .peringatan-stok {
            font-size: 11px;
            color: red;
            display: block;
            margin-top: 4px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Daftar Permintaan Stok (Dari Cabang)</h2>

        @if (session('success'))
            <div
                style="color: green; margin-bottom: 15px; font-weight: bold; background: #d4edda; padding: 10px; border-radius: 4px;">
                {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div
                style="color: red; margin-bottom: 15px; font-weight: bold; background: #f8d7da; padding: 10px; border-radius: 4px;">
                {{ session('error') }}</div>
        @endif

        <table>
            <tr>
                <th>Waktu Request</th>
                <th>Judul Buku</th>
                <th>Qty Diminta</th>
                <th>Sisa Stok Pusat</th>
                <th>Catatan Cabang</th>
                <th>Aksi Persetujuan</th>
                <th>Pemninta Cabang</th>
            </tr>
            @forelse($permintaan as $item)
                @php
                    $stokGudang = $item->stokPusat ? $item->stokPusat->qty_tersedia : 0;
                    $stokCukup = $stokGudang >= $item->qty;
                @endphp
                <tr>
                    <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                    <td><strong>{{ $item->buku->judul ?? 'Data Buku Dihapus' }}</strong></td>

                    <td><span style="font-size: 16px; font-weight: bold; color: #007bff;">{{ $item->qty }} Unit</span>
                    </td>

                    <td>
                        <span style="font-size: 16px; font-weight: bold; color: {{ $stokCukup ? 'green' : 'red' }};">
                            {{ $stokGudang }} Unit
                        </span>
                    </td>

                    <td>{{ $item->catatan_cabang ?? '-' }}</td>

                    <td>
                        <strong>{{ $item->cabang->nama_cabang ?? 'N/A' }}</strong><br>
                        <small style="color: gray;">Kode: {{ $item->cabang->kode_cabang ?? '-' }}</small>
                    </td>

                    <td>
                        <form action="{{ route('pusat.request.proses', $item->id) }}" method="POST"
                            style="display:inline;">
                            @csrf

                            <button type="submit" name="aksi" value="TERIMA" class="btn btn-terima"
                                {{ $stokCukup ? '' : 'disabled' }}
                                onclick="return confirm('Setujui dan buat Surat Jalan pengiriman sekarang?')">
                                Setujui & Kirim
                            </button>

                            <button type="submit" name="aksi" value="TOLAK" class="btn btn-tolak"
                                onclick="return confirm('Tolak permintaan dari cabang ini?')">
                                Tolak
                            </button>
                        </form>

                        @if (!$stokCukup)
                            <span class="peringatan-stok">⚠️ Stok gudang tidak cukup!</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 30px;">Belum ada permintaan (Request)
                        tertunda dari cabang.</td>
                </tr>
            @endforelse
        </table>
    </div>

</body>

</html>
