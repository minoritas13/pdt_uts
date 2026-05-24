@extends('layouts.admin')

@section('title', 'Penerimaan Barang Cabang (Inbound) — SPBT Admin')

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

    .ref-sj {
        font-weight: 700;
        color: var(--navy);
        background: var(--gray-100);
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12.5px;
    }

    .book-title {
        font-weight: 600;
        color: var(--gray-800);
    }

    .qty-badge {
        font-weight: 700;
        color: #0c73be;
    }

    .time-text {
        color: var(--gray-600);
        font-size: 13px;
    }

    /* ─── ACTION BUTTONS ─── */
    .btn-accept {
        background: #22c55e;
        color: var(--white);
        border: none;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 12.5px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        box-shadow: 0 2px 6px rgba(34, 197, 94, 0.2);
        transition: background 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-accept:hover {
        background: #16a34a;
    }

    /* ─── FLASH ALERTS ─── */
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
        padding: 48px !important;
        color: var(--gray-400);
        font-size: 14px;
    }

    @media (max-width: 768px) {
        th, td { padding: 12px 16px; }
        .btn-accept { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Penerimaan Barang Cabang (Inbound)</h1>
    <p>Periksa manifest fisik buku kiriman pusat sebelum dimasukkan ke dalam rak stok cabang.</p>
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
                <th style="width: 20%;">No. Referensi (SJ)</th>
                <th style="width: 40%;">Judul Buku</th>
                <th style="width: 12%;">Jumlah (Qty)</th>
                <th style="width: 15%;">Waktu Dikirim</th>
                <th style="width: 13%; text-align: right;">Aksi Pengecekan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengirimanDiJalan as $item)
            <tr>
                <td><span class="ref-sj">{{ $item->keterangan }}</span></td>
                <td><span class="book-title">{{ $item->buku->judul ?? 'N/A' }}</span></td>
                <td><span class="qty-badge">{{ $item->qty }} Eks</span></td>
                <td><span class="time-text">{{ $item->waktu }}</span></td>
                <td style="text-align: right;">
                    <form action="{{ route('cabang.penerimaan.terima', $item->id) }}" method="POST" onsubmit="return confirm('Fisik barang sesuai dengan surat jalan? Lanjutkan tambah ke stok rak?')">
                        @csrf
                        <button type="submit" class="btn-accept">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            Terima & ACC
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-state">
                    <div style="margin-bottom: 8px;">
                        <svg width="40" height="40" fill="none" stroke="var(--gray-400)" stroke-width="1.5" viewBox="0 0 24 24" style="display: inline-block;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.129-1.125V11.25M3 14.25h6.25a2.25 2.25 0 002.008-1.24l.885-1.77a2.25 2.25 0 012.007-1.24H21m-18 4.25V7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v3.75m-18 3h18"/>
                        </svg>
                    </div>
                    Belum ada barang baru yang sedang dalam perjalanan dari pusat.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
