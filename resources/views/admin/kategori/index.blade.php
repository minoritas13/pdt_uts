<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kategori Buku</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        .container { max-width: 800px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #007bff; }
        .btn-add { background-color: #007bff; color: white; text-decoration: none; padding: 10px 15px; border-radius: 4px; font-weight: bold; font-size: 14px; }
        .btn-add:hover { background-color: #0056b3; }

        .alert-success { background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-weight: bold; }

        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f8f9fa; font-weight: bold; color: #555; }
        tr:hover { background-color: #f9fafb; }

        .btn-edit { background-color: #ffc107; color: #212529; text-decoration: none; padding: 6px 12px; border-radius: 4px; font-weight: bold; font-size: 13px; margin-right: 5px; display: inline-block; }
        .btn-edit:hover { background-color: #e0a800; }

        .btn-delete { background-color: #dc3545; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 13px; }
        .btn-delete:hover { background-color: #c82333; }

        .empty-state { text-align: center; padding: 30px; color: #777; font-style: italic; }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h2>Master Data Kategori</h2>
            <a href="{{ route('kategori.create') }}" class="btn-add">+ Tambah Kategori</a>
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 60%;">Nama Kategori</th>
                    <th style="width: 30%; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kategori as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><strong>{{ $item->nama_kategori }}</strong></td>
                    <td style="text-align: center;">
                        <a href="{{ route('kategori.edit', $item->id) }}" class="btn-edit">Edit</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="empty-state">Belum ada data kategori di database pusat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
