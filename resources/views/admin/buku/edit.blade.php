<div>
    <a href="{{ route('buku.index') }}">back</a>
</div>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Buku</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="number"], select {
            width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;
        }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 4px;}
        button:hover { background-color: #0056b3; }
        .btn-batal { background-color: #6c757d; text-decoration: none; padding: 10px 15px; color: white; border-radius: 4px; margin-left: 10px; }
        .text-danger { color: red; font-size: 0.9em; margin-top: 5px; display: block; }
    </style>
</head>
<body>

    <h2>Form Edit Buku</h2>

    <form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="judul">Judul Buku</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required>
            @error('judul') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
            @error('penulis') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}" required>
            @error('isbn') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="kategori_id">Kategori</label>
            <select id="kategori_id" name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                    <option value="{{ $kat->id }}" {{ old('kategori_id', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>
                        {{ $kat->nama_kategori }}
                    </option>
                @endforeach
            </select>
            @error('kategori_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="penerbit_id">Penerbit</label>
            <select id="penerbit_id" name="penerbit_id" required>
                <option value="">-- Pilih Penerbit --</option>
                @foreach($penerbit as $pen)
                    <option value="{{ $pen->id }}" {{ old('penerbit_id', $buku->penerbit_id) == $pen->id ? 'selected' : '' }}>
                        {{ $pen->nama_penerbit }}
                    </option>
                @endforeach
            </select>
            @error('penerbit_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="harga_nasional">Harga Nasional (Rp)</label>
            <input type="number" id="harga_nasional" name="harga_nasional" value="{{ old('harga_nasional', (int)$buku->harga_nasional) }}" min="0" required>
            @error('harga_nasional') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Update Data</button>
        <a href="{{ route('buku.index') }}" class="btn-batal">Batal</a>
    </form>

</body>
</html>
