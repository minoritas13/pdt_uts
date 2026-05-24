@extends('layouts.admin')

@section('title', 'Kelola User — SPBT Admin')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        gap: 16px;
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

    .btn-add {
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        background: var(--navy);
        color: var(--white);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.18s;
    }

    .btn-add:hover {
        background: var(--navy-light);
    }

    /* ─── TABLE CARD COMPONENT ─── */
    .table-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.03);
        overflow: hidden;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        padding: 14px 24px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        color: var(--gray-400);
        text-transform: uppercase;
        letter-spacing: 0.6px;
        background: var(--gray-50);
        border-bottom: 1px solid var(--gray-100);
    }

    td {
        padding: 14px 24px;
        font-size: 13.5px;
        color: var(--gray-800);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:hover td {
        background: var(--gray-50);
    }

    .user-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e8f7fd;
        color: #0c73be;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .user-name {
        font-weight: 700;
        color: var(--gray-800);
    }

    .user-email {
        color: var(--gray-600);
    }

    /* ─── BADGES ROLE COMPONENT ─── */
    .role-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .badge-superadmin { background: var(--red-bg); color: #b91c1c; }
    .badge-branch { background: #e0f2fe; color: #0369a1; }
    .badge-cashier { background: var(--green-bg); color: #15803d; }
    .badge-customer { background: var(--gray-100); color: var(--gray-600); }

    /* ─── ACTION BUTTONS ─── */
    .action-container {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-edit {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--navy);
        text-decoration: none;
        padding: 5px 12px;
        border-radius: 6px;
        border: 1.5px solid var(--gray-200);
        transition: all 0.15s;
    }

    .btn-edit:hover {
        border-color: var(--navy);
        background: var(--gray-50);
    }

    .btn-delete {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--red);
        background: none;
        border: 1.5px solid var(--gray-200);
        padding: 5px 12px;
        border-radius: 6px;
        cursor: pointer;
        font-family: inherit;
        transition: all 0.15s;
    }

    .btn-delete:hover {
        border-color: var(--red);
        background: var(--red-bg);
    }

    /* ─── ALERT FLASH SYSTEM ─── */
    .alert-toast {
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 13.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .alert-toast.success { background: var(--green-bg); color: #15803d; border: 1px solid rgba(34, 197, 94, 0.2); }
    .alert-toast.error { background: var(--red-bg); color: #b91c1c; border: 1px solid rgba(239, 68, 68, 0.2); }

    @media (max-width: 768px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-add { width: 100%; justify-content: center; }
        th, td { padding: 12px 16px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1>Kelola User</h1>
        <p>Manajemen tingkat hak akses kontrol dan akun otentikasi sistem SPBT.</p>
    </div>
    <a href="{{ route('user.create') }}" class="btn-add">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Akun Baru
    </a>
</div>

@if(session('success'))
    <div class="alert-toast success">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-toast error">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
        </svg>
        {{ session('error') }}
    </div>
@endif

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>Nama Lengkap</th>
                <th>Alamat Email</th>
                <th>Hak Akses (Role)</th>
                <th style="text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $item)
            <tr>
                <td>
                    <div class="user-cell">
                        <div class="user-avatar">{{ strtoupper(substr($item->name, 0, 1)) }}</div>
                        <span class="user-name">{{ $item->name }}</span>
                    </div>
                </td>
                <td><span class="user-email">{{ $item->email }}</span></td>
                <td>
                    @if($item->role == 'SUPER_ADMIN') 
                        <span class="role-badge badge-superadmin">Pusat</span>
                    @elseif($item->role == 'ADMIN_CABANG') 
                        <span class="role-badge badge-branch">Cabang</span>
                    @elseif($item->role == 'KASIR') 
                        <span class="role-badge badge-cashier">Kasir</span>
                    @else 
                        <span class="role-badge badge-customer">Pelanggan</span>
                    @endif
                </td>
                <td>
                    <div class="action-container" style="justify-content: flex-end;">
                        <a href="{{ route('user.edit', $item->id) }}" class="btn-edit">Edit</a>
                        <form action="{{ route('user.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus akun ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
