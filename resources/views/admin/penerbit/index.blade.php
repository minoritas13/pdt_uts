<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Penerbit Pusat</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body class="">

    <h2>Daftar Penerbit(Data Master)</h2>
    <a href="{{route('penerbit.create')}}">Tambah Penerbit</a>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Penerbit</th>
                <th>Kota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penerbit as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_penerbit ?? 'Kosong' }}</td>
                <td>{{ $item->kota ?? 'kosong' }}</td>

                <td>
                    <form action="{{ route('penerbit.destroy', $item->id) }}" method="POST" onsubmit="return confirm ('apakah anda yain untuk delete?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" > Hapus </button>
                    </form>

                    <a href="{{ route('penerbit.edit', $item->id) }}">edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
