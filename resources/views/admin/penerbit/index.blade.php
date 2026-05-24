@extends('layouts.admin')

@section('title', 'Master Data Penerbit — SPBT Admin')

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

    .publisher-id {
        font-weight: 700;
        color: var(--navy-light);
    }

    .publisher-name {
        font-weight: 700;
        color: var(--gray-800);
    }

    .city-text {
        font-weight: 500;
        color: var(--gray-600);
    }

    .text-muted-empty {
        color: var(--gray-400);
        font-style: italic;
        font-size: 12.5px;
    }

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

    @media (max-width: 640px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-add { width: 100%; justify-content: center; }
        th, td { padding: 12px 16px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1>Daftar Penerbit (Data Master)</h1>
        <p>Kelola korporasi mitra penerbit percetakan buku terdistribusi.</p>
    </div>
    <a href="{{ route('penerbit.create') }}" class="btn-add">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Tambah Penerbit
    </a>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width: 12%;">ID</th>
                <th style="width: 50%;">Nama Penerbit</th>
                <th style="width: 23%;">Kota</th>
                <th style="width: 15%; text-align: right;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penerbit as $item)
            <tr>
                <td><span class="publisher-id">#{{ $item->id }}</span></td>
                <td>
                    <span class="publisher-name">
                        {{ $item->nama_penerbit ?? 'Kosong' }}
                    </span>
                </td>
                <td>
                    @if($item->kota)
                        <span class="city-text">{{ $item->kota }}</span>
                    @else
                        <span class="text-muted-empty">tidak ada data kota</span>
                    @endif
                </td>
                <td>
                    <div class="action-container" style="justify-content: flex-end;">
                        <a href="{{ route('penerbit.edit', $item->id) }}" class="btn-edit">Edit</a>
                        
                        <form action="{{ route('penerbit.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah anda yakin untuk delete?')">
                            @csrf
                            @method('DELETE')
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
