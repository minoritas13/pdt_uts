<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun Baru</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .register-card { background: #fff; padding: 35px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; box-sizing: border-box; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 6px; font-size: 14px; }
        input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-register { background-color: #28a745; color: white; width: 100%; padding: 12px; border: none; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        .btn-register:hover { background-color: #218838; }
        .error-text { color: red; font-size: 12px; margin-top: 4px; display: block; font-weight: bold; }
        .link-login { display: block; text-align: center; margin-top: 20px; color: #007bff; text-decoration: none; font-size: 14px; }
        .link-login:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="register-card">
    <h2 style="margin-top: 0; text-align: center; color: #333;">Buat Akun</h2>
    <p style="text-align: center; color: #777; margin-bottom: 25px;">Silakan isi formulir pendaftaran</p>

    <form action="{{ route('register.proses') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama Anda">
            @error('name') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required placeholder="contoh@email.com">
            @error('email') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi (Min. 8 Karakter)</label>
            <input type="password" name="password" id="password" required placeholder="Buat kata sandi">
            @error('password') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi kata sandi">
        </div>

        <button type="submit" class="btn-register">Daftar Sekarang</button>
    </form>

    <a href="{{ route('login') }}" class="link-login">Sudah punya akun? Silakan Masuk</a>
</div>

</body>
</html>
