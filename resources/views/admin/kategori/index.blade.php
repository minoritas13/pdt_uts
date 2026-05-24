@extends('layouts.admin')

@section('title', 'Master Data Kategori — SPBT Admin')

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
        padding: 16px 24px;
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

    .category-id {
        font-weight: 700;
        color: var(--navy-light);
    }

    .category-name {
        font-weight: 600;
        color: var(--gray-800);
    }

    /* ─── ACTION BUTTONS ─── */
    .btn-edit {
        font-size: 12.5px;
        font-weight: 600;
        color: var(--navy);
        text-decoration: none;
        padding: 6px 14px;
        border-radius: 30px;
        border: 1.5px solid var(--gray-200);
        transition: all 0.15s;
        display: inline-block;
    }

    .btn-edit:hover {
        border-color: var(--navy);
        background: var(--gray-50);
    }

    /* ─── TOAST / NOTIFICATION ─── */
    .alert-success {
        background: var(--green-bg);
        color: #15803d;
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        border: 1px solid rgba(34, 197, 94, 0.2);
        font-size: 13.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .empty-state {
        text-align: center;
        padding: 48px !--important;
        color: var(--gray-400);
        font-size: 14px;
    }

    @media (max-width: 640px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .btn-add {
            width: 100%;
            justify-content: center;
        }
        th, td {
            padding: 12px 16px;
        }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1>Master Data Kategori</h1>
        <p>Kelola pembagian rumpun kategori pustaka buku pada sistem pusat.</p>
    </div>
    <a href="{{ route('kategori.create') }}" class="btn-add">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Kategori
    </a>
</div>

@if(session('success'))
    <div class="alert-success">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width: 15%;">ID Kategori</th>
                <th style="width: 65%;">Nama Kategori Buku</th>
                <th style="width: 20%; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategori as $item)
            <tr>
                <td><span class="category-id">#{{ $item->id }}</span></td>
                <td><span class="category-name">{{ $item->nama_kategori }}</span></td>
                <td style="text-align: right;">
                    <a href="{{ route('kategori.edit', $item->id) }}" class="btn-edit">Edit</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="empty-state">
                    <div style="margin-bottom: 8px;">
                        <svg width="40" height="40" fill="none" stroke="var(--gray-400)" stroke-width="1.5" viewBox="0 0 24 24" style="display: inline-block;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v4.5A2.25 2.25 0 002.25 13.5zm0 0V16.5A2.25 2.25 0 004.5 18.75h15a2.25 2.25 0 002.25-2.25V13.5m-18 0V16.5"/>
                        </svg>
                    </div>
                    Belum ada data kategori di database pusat.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
