<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku Pusat</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body class="">

    <h2>Daftar Buku (Data Master)</h2>
    <a href="{{route('buku.create')}}"></a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul Buku</th>
                <th>ISBN</th>
                <th>Kategori</th>
                <th>Penerbit</th>
                <th>Harga Nasional</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buku as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->isbn }}</td>
                
                <td>{{ $item->kategori->nama_kategori ?? 'Kosong' }}</td>
                <td>{{ $item->penerbit->nama_penerbit ?? 'Kosong' }}</td>
                
                <td>Rp {{ number_format($item->harga_nasional, 0, ',', '.') }}</td>

                <td>
                    <form action="{{ route('buku.destroy', $item->id) }}" method="POST" onsubmit="return confirm ('apakah anda yain untuk delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" > Hapus </button>
                    </form></td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>