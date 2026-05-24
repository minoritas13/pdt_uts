@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru — SPBT Admin')

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
        max-width: 580px;
    }

    .form-grid {
        display: flex;
        flex-direction: column;
        gap: 20px;
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
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Tambah Akun Sistem</h1>
    <p>Daftarkan kredensial akun baru beserta delegasi otorisasi tugasnya.</p>
</div>

<div class="form-card">
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        
        <div class="form-grid">
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="contoh@domain.com" required>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required minlength="8">
            </div>

            <div class="form-group">
                <label for="role">Hak Akses (Role)</label>
                <select id="role" name="role" required>
                    <option value="PELANGGAN">Pelanggan Umum</option>
                    <option value="KASIR">Kasir Toko</option>
                    <option value="ADMIN_CABANG">Admin Cabang</option>
                    <option value="SUPER_ADMIN">Super Admin (Pusat)</option>
                </select>
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('user.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">Simpan Akun</button>
        </div>
    </form>
</div>

@endsection
