@extends('layouts.admin')

@section('title', 'Edit Data Buku — SPBT Admin')

@push('styles')
<style>
    .page-header {
        margin-bottom: 24px;
    }
    .page-header h1 {
        font-size: 22px;
        font-weight: 800;
        color: var(--gray-800);
    }
    .page-header p {
        font-size: 13.5px;
        color: var(--gray-400);
        margin-top: 2px;
    }

    /* ─── FORM CARD COMPONENT ─── */
    .form-card {
        background: var(--white);
        border-radius: 16px;
        padding: 28px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.03);
        max-width: 700px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        margin-bottom: 4px;
    }

    .form-group.full-width {
        grid-column: span 2;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 8px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 12px 18px;
        border: 1px solid var(--gray-200);
        border-radius: 30px;
        font-size: 13.5px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        outline: none;
        color: var(--gray-800);
        background-color: var(--white);
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #0c73be;
        box-shadow: 0 0 0 3px rgba(12, 115, 190, 0.1);
    }

    /* ─── ACTION BUTTONS ─── */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 32px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-100);
    }

    .btn-update {
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        background: #0c73be; /* Menggunakan warna dasar biru seragam */
        color: var(--white);
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: background 0.2s;
    }

    .btn-update:hover {
        background: #0b4a99;
    }

    .btn-cancel {
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 13.5px;
        font-weight: 600;
        border: 1.5px solid var(--gray-200);
        background: var(--white);
        color: var(--gray-600);
        text-decoration: none;
        text-align: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        border-color: var(--red);
        color: var(--red);
        background: var(--red-bg);
    }

    .text-danger {
        color: var(--red);
        font-size: 11.5px;
        font-weight: 600;
        margin-top: 6px;
        padding-left: 14px;
        display: block;
    }

    /* ─── RESPONSIVE DESIGN ─── */
    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-group.full-width {
            grid-column: span 1;
        }
        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }
        .btn-update, .btn-cancel {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Edit Data Buku</h1>
    <p>Silakan perbarui data informasi pustaka sesuai perubahan terbaru.</p>
</div>

<div class="form-card">
    <form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
            
            <div class="form-group full-width">
                <label for="judul">Judul Buku</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" required>
                @error('judul') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="form-group">
                <label for="penulis">Penulis / Pengarang</label>
                <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" required>
                @error('penulis') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}" required>
                @error('isbn') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="form-group">
                <label for="kategori_id">Kategori Buku</label>
                <select id="kategori_id" name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id', $buku->kategori_id) == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
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
                @error('penerbit_id') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

            <div class="form-group full-width">
                <label for="harga_nasional">Harga Nasional (Rp)</label>
                <input type="number" id="harga_nasional" name="harga_nasional" value="{{ old('harga_nasional', (int)$buku->harga_nasional) }}" min="0" required>
                @error('harga_nasional') 
                    <span class="text-danger">{{ $message }}</span> 
                @enderror
            </div>

        </div>

        <div class="form-actions">
            <a href="{{ route('buku.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-update">Update Data</button>
        </div>
    </form>
</div>

@endsection
