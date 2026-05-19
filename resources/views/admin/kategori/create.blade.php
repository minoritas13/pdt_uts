<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori Baru</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 20px; }
        label { display: block; font-weight: bold; margin-bottom: 8px; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; }
        input[type="text"]:focus { border-color: #007bff; outline: none; }
        .btn-submit { background-color: #007bff; color: white; padding: 12px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; font-size: 15px; }
        .btn-submit:hover { background-color: #0056b3; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #6c757d; text-decoration: none; font-weight: bold; font-size: 14px; }
        .btn-back:hover { color: #333; }
        .text-danger { color: #dc3545; font-size: 13px; margin-top: 5px; display: block; font-weight: bold; }
    </style>
</head>
<body>

    <div class="container">
        <a href="{{ route('kategori.index') }}" class="btn-back">← Kembali ke Daftar Kategori</a>

        <h2 style="margin-top: 0; color: #333;">Tambah Kategori</h2>

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama_kategori">Nama Kategori Buku <span style="color:red;">*</span></label>
                <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" required autofocus placeholder="Contoh: Novel, Komik, Teknologi">
                @error('nama_kategori')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Simpan Kategori Baru</button>
        </form>
    </div>

</body>
</html>
