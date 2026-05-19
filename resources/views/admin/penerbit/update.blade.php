<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penerbit</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; color: #333; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .btn-submit { background-color: #28a745; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; width: 100%; }
        .btn-submit:hover { background-color: #218838; }
        .btn-back { display: inline-block; margin-bottom: 20px; color: #6c757d; text-decoration: none; font-weight: bold; }
        .text-danger { color: red; font-size: 13px; margin-top: 5px; display: block; }
    </style>
</head>
<body>

    <div class="container">
        <a href="{{ route('penerbit.index') }}" class="btn-back">← Kembali ke Daftar Penerbit</a>

        <h2 style="margin-top: 0;">Edit Data Penerbit</h2>

        <form action="{{ route('penerbit.update', $penerbit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_penerbit">Nama Penerbit <span style="color:red;">*</span></label>
                <input type="text" name="nama_penerbit" id="nama_penerbit" value="{{ old('nama_penerbit', $penerbit->nama_penerbit) }}" required>
                @error('nama_penerbit')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="kota">Kota (Opsional)</label>
                <input type="text" name="kota" id="kota" value="{{ old('kota', $penerbit->kota) }}">
                @error('kota')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Update Data Penerbit</button>
        </form>
    </div>

</body>
</html>
