<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pengguna</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background: #f8f9fa; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; border: none; cursor: pointer; font-weight: bold; }
        .btn-add { background: #007bff; }
        .btn-edit { background: #ffc107; color: #333; }
        .btn-delete { background: #dc3545; }
        .role-badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; color: white; }
    </style>
</head>
<body>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Kelola Akses Pengguna</h2>
        <a href="{{ route('user.create') }}" class="btn btn-add">+ Tambah Akun Baru</a>
    </div>

    @if(session('success')) <div style="color: green; margin: 15px 0;">{{ session('success') }}</div> @endif
    @if(session('error')) <div style="color: red; margin: 15px 0;">{{ session('error') }}</div> @endif

    <table>
        <tr>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Peran (Role)</th>
            <th>Aksi</th>
        </tr>
        @foreach($users as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>
                @if($item->role == 'SUPER_ADMIN') <span class="role-badge" style="background: red;">PUSAT</span>
                @elseif($item->role == 'ADMIN_CABANG') <span class="role-badge" style="background: blue;">CABANG</span>
                @elseif($item->role == 'KASIR') <span class="role-badge" style="background: green;">KASIR</span>
                @else <span class="role-badge" style="background: gray;">PELANGGAN</span>
                @endif
            </td>
            <td>
                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-edit">Edit</a>
                <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus akun ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-delete">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>

</body>
</html>
