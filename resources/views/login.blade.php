<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Log In</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: #fff; padding: 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 8px; }
        input[type="email"], input[type="password"] { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-login { background-color: #007bff; color: white; width: 100%; padding: 12px; border: none; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer; }
        .btn-login:hover { background-color: #0056b3; }
        .error-text { color: red; font-size: 13px; margin-top: 5px; display: block; }
    </style>
</head>
<body>

<div class="login-card">
    <h2 style="margin-top: 0; text-align: center; color: #333;">Selamat Datang</h2>
    <p style="text-align: center; color: #777; margin-bottom: 30px;">Silakan masuk ke akun Anda</p>

    <form action="{{ route('login.proses') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
            @error('email') <span class="error-text">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="btn-login">Masuk Aplikasi</button>
    </form>
</div>

</body>
</html>