<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f6; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 20px; box-sizing: border-box; }
        .card { background: #fff; padding: 30px; border-radius: 8px; width: 100%; max-width: 450px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); box-sizing: border-box; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-weight: bold; margin-bottom: 6px; font-size: 14px; color: #333; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; }
        input:focus, select:focus { border-color: #28a745; outline: none; }
        .help-text { font-size: 12px; color: #6c757d; margin-top: 4px; display: block; font-style: italic; }
        button { background: #28a745; color: white; width: 100%; padding: 12px; border: none; font-weight: bold; cursor: pointer; border-radius: 4px; font-size: 16px; margin-top: 10px; }
        button:hover { background: #218838; }
        .btn-back { text-decoration: none; color: #6c757d; font-weight: bold; font-size: 14px; display: inline-block; margin-bottom: 20px; }
        .btn-back:hover { color: #333; }
        .text-danger { color: #dc3545; font-size: 12px; margin-top: 4px; display: block; font-weight: bold; }
    </style>
</head>
<body>

<div class="card">
    <a href="{{ route('user.index') }}" class="btn-back">&larr; Kembali ke Daftar</a>
    <h3 style="margin-top: 0; color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px;">Edit Akun Sistem</h3>

    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi Baru (Opsional)</label>
            <input type="password" name="password" id="password" minlength="8">
            <small class="help-text">Biarkan kolom ini kosong jika tidak ingin merubah kata sandi pengguna.</small>
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="role">Hak Akses (Role)</label>
            <select name="role" id="role" required>
                <option value="PELANGGAN" {{ old('role', $user->role) === 'PELANGGAN' ? 'selected' : '' }}>Pelanggan Umum</option>
                <option value="KASIR" {{ old('role', $user->role) === 'KASIR' ? 'selected' : '' }}>Kasir Toko</option>
                <option value="ADMIN_CABANG" {{ old('role', $user->role) === 'ADMIN_CABANG' ? 'selected' : '' }}>Admin Cabang</option>
                <option value="SUPER_ADMIN" {{ old('role', $user->role) === 'SUPER_ADMIN' ? 'selected' : '' }}>Super Admin (Pusat)</option>
            </select>
            @error('role') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Perbarui Data Akun</button>
    </form>
</div>

</body>
</html>
