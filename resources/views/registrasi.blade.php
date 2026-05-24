<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - SPBT</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Menggunakan min-height agar bisa di-scroll di HP */
            padding: 20px;
        }

        .container {
            display: flex;
            width: 100%;
            max-width: 1100px;
            min-height: 600px; /* Disamakan dengan login agar konsisten */
            gap: 40px;
            align-items: center;
            justify-content: center;
        }

        /* --- SISI KIRI: ILUSTRASI (DESKTOP ONLY) --- */
        .illustration-side {
            flex: 1;
            background-color: #e8f7fd;
            border-radius: 24px;
            align-self: stretch;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            padding: 30px;
        }

        .illustration-side img {
            width: 100%;
            max-width: 400px;
            height: auto;
            object-fit: contain;
        }

        /* --- SISI KANAN: FORM DAFTAR --- */
        .form-side {
            flex: 1;
            width: 100%;
            max-width: 420px;
            padding: 10px 0;
        }

        .brand-header {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-bottom: 24px;
            color: #0c73be;
            font-weight: 700;
            font-size: 24px;
        }

        .brand-header i {
            font-size: 28px;
        }

        .welcome-text {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            color: #111111;
            margin-bottom: 6px;
        }

        .sub-text {
            text-align: center;
            font-size: 14px;
            color: #666666;
            margin-bottom: 30px;
        }

        .tab-navigation {
            background-color: #0c73be;
            border-radius: 30px;
            display: flex;
            padding: 4px;
            margin-bottom: 30px;
        }

        .tab-btn {
            flex: 1;
            text-align: center;
            padding: 12px 0;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .tab-btn.active {
            background-color: #0b4a99;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #111111;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #cccccc;
            border-radius: 30px;
            font-size: 14px;
            outline: none;
            color: #333333;
            transition: border-color 0.3s ease;
        }

        /* Memberi ruang kanan khusus untuk input password agar tidak menabrak ikon mata */
        .input-wrapper input[type="password"],
        .input-wrapper input[type="text"].has-icon {
            padding-right: 50px;
        }

        .input-wrapper input::placeholder {
            color: #bbbbbb;
        }

        .input-wrapper input:focus {
            border-color: #0c73be;
        }

        .input-wrapper .field-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #444444;
            font-size: 16px;
        }

        .btn-submit {
            background-color: #0c73be;
            color: #ffffff;
            width: 100%;
            padding: 14px;
            border: none;
            font-size: 15px;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn-submit:hover {
            background-color: #0b4a99;
        }

        .form-footer {
            text-align: center;
            font-size: 13px;
            color: #555555;
        }

        .form-footer a {
            color: #0c73be;
            text-decoration: none;
            font-weight: 600;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .error-text {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            padding-left: 15px;
            display: block;
        }

        /* --- RESPONSIVE ENGINE --- */
        @media (max-width: 1024px) {
            .container {
                gap: 30px;
                max-width: 900px;
            }
        }

        @media (max-width: 850px) {
            body {
                padding: 30px 20px; /* Memberikan ruang aman saat di-scroll di HP */
            }
            .container {
                max-width: 100%;
                min-height: auto;
                padding: 0;
            }
            .illustration-side {
                display: none; /* Sembunyikan gambar di HP */
            }
            .form-side {
                max-width: 450px;
            }
        }

        @media (max-width: 360px) {
            .welcome-text {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="illustration-side">
        <img src="{{ asset('images/buku.png') }}" alt="Ilustrasi Register SPBT">
    </div>

    <div class="form-side">
        <div class="brand-header">
            <i class="fa-solid fa-book-open-reader"></i> SPBT
        </div>

        <h2 class="welcome-text">Daftar Akun Baru</h2>
        <p class="sub-text">Silakan lengkapi data diri anda untuk mendaftar.</p>

        <div class="tab-navigation">
            <a href="{{ route('login') }}" class="tab-btn">Masuk</a>
            <a href="#" class="tab-btn active">Daftar</a>
        </div>

        <form action="{{ route('register.proses') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="name">Nama Pengguna</label>
                <div class="input-wrapper">
                    <input type="text" name="name" id="name" placeholder="Masukkan nama pengguna Anda" value="{{ old('name') }}" required autofocus>
                </div>
                @error('name') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" name="email" id="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                </div>
                @error('email') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" name="password" id="password" placeholder="Masukkan kata sandi Anda" required>
                    <i class="fa-regular fa-eye-slash field-icon" id="eyePassword" onclick="toggleVisibility('password', 'eyePassword')"></i>
                </div>
                @error('password') <span class="error-text">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                <div class="input-wrapper">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi kata sandi Anda" required>
                    <i class="fa-regular fa-eye-slash field-icon" id="eyeConfirm" onclick="toggleVisibility('password_confirmation', 'eyeConfirm')"></i>
                </div>
            </div>

            <button type="submit" class="btn-submit">Daftar</button>
        </form>

        <div class="form-footer">
            Punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
</div>

<script>
    function toggleVisibility(inputId, iconId) {
        const inputField = document.getElementById(inputId);
        const eyeIcon = document.getElementById(iconId);
        
        if (inputField.type === 'password') {
            inputField.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            inputField.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
</script>
</body>
</html>
