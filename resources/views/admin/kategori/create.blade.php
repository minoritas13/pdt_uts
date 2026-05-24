@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru — SPBT Admin')

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
        max-width: 540px;
    }

    .form-group {
        margin-bottom: 4px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-800);
        margin-bottom: 8px;
    }

    .form-group label span {
        color: var(--red);
    }

    .form-group input {
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

    .form-group input:focus {
        border-color: #0c73be;
        box-shadow: 0 0 0 3px rgba(12, 115, 190, 0.1);
    }

    .form-group input::placeholder {
        color: var(--gray-400);
    }

    /* ─── ACTION BUTTONS ─── */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid var(--gray-100);
    }

    .btn-save {
        flex: 1;
        padding: 12px 20px;
        border-radius: 30px;
        font-size: 13.5px;
        font-weight: 600;
        border: none;
        background: #0c73be;
        color: var(--white);
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: background 0.2s;
        text-align: center;
    }

    .btn-save:hover {
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

    @media (max-width: 480px) {
        .form-actions {
            flex-direction: column-reverse;
            align-items: stretch;
        }
        .btn-save, .btn-cancel {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Tambah Kategori Buku</h1>
    <p>Gunakan form berikut untuk memperluas rumpun kategori koleksi.</p>
</div>

<div class="form-card">
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori Buku <span>*</span></label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" required autofocus placeholder="Contoh: Novel, Komik, Teknologi">
            @error('nama_kategori')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('kategori.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Kategori Baru</button>
        </div>
    </form>
</div>

@endsection
