<h2>Penerimaan Barang Cabang (Inbound)</h2>

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left;">
    <thead style="background: #f4f4f4;">
        <tr>
            <th>No. Referensi (SJ)</th>
            <th>Judul Buku</th>
            <th>Jumlah (Qty)</th>
            <th>Waktu Dikirim Pusat</th>
            <th>Aksi Pengecekan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pengirimanDiJalan as $item)
        <tr>
            <td><strong>{{ $item->keterangan }}</strong></td>
            <td>{{ $item->buku->judul ?? 'N/A' }}</td>
            <td>{{ $item->qty }} Unit</td>
            <td>{{ $item->waktu }}</td>
            <td>
                <form action="{{ route('cabang.penerimaan.terima', $item->id) }}" method="POST" onsubmit="return confirm('Fisik barang sesuai dengan surat jalan? Lanjutkan tambah ke stok rak?')">
                    @csrf
                    <button type="submit" style="background: #28a745; color: white; border: none; padding: 8px 12px; cursor: pointer;">
                        Barang Diterima & ACC
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" style="text-align: center; padding: 20px;">
                Belum ada barang baru yang sedang dalam perjalanan dari pusat.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
