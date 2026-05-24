@extends('layouts.admin')

@section('title', 'Edit Pengguna — SPBT Admin')

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

    .help-text {
        font-size: 11.5px;
        color: var(--gray-400);
        margin-top: 6px;
        padding-left: 14px;
        display: block;
        font-style: italic;
    }

    .text-danger {
        color: var(--red);
        font-size: 11.5px;
        font-weight: 600;
        margin-top: 6px;
        padding-left: 14px;
        display: block;
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

    .btn-update {
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
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Edit Akun Sistem</h1>
    <p>Perbarui profil identitas atau ubah tingkat kedudukan hak akses pengguna.</p>
</div>

<div class="form-card">
    <form action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-grid">
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
                <input type="password" name="password" id="password" placeholder="Isi hanya jika ingin mengganti sandi" minlength="8">
                <span class="help-text">Biarkan kolom ini kosong jika tidak ingin merubah kata sandi pengguna.</span>
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
        </div>

        <div class="form-actions">
            <a href="{{ route('user.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-update">Perbarui Data Akun</button>
        </div>
    </form>
</div>

@endsection
