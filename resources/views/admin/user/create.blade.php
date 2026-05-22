<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; display: flex; justify-content: center; padding: 40px; }
        .card { background: #fff; padding: 30px; border-radius: 8px; width: 400px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background: #007bff; color: white; width: 100%; padding: 12px; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; }
    </style>
</head>
<body>

<div class="card">
    <a href="{{ route('user.index') }}" style="text-decoration: none; color: #666; margin-bottom: 20px; display: block;">&larr; Kembali</a>
    <h3>Tambah Akun Sistem</h3>

    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Kata Sandi</label>
            <input type="password" name="password" required minlength="8">
        </div>
        <div class="form-group">
            <label>Hak Akses (Role)</label>
            <select name="role" required>
                <option value="PELANGGAN">Pelanggan Umum</option>
                <option value="KASIR">Kasir Toko</option>
                <option value="ADMIN_CABANG">Admin Cabang</option>
                <option value="SUPER_ADMIN">Super Admin (Pusat)</option>
            </select>
        </div>
        <button type="submit">Simpan Akun</button>
    </form>
</div>

</body>
</html>
