@extends('layouts.admin')

@section('title', 'Histori Laporan Distribusi — SPBT Admin')

@push('styles')
<style>
    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 22px; font-weight: 800; color: var(--gray-800); }
    .page-header p  { font-size: 13.5px; color: var(--gray-400); margin-top: 2px; }

    /* ─── FILTER CONTROL BAR ─── */
    .filter-card {
        background: var(--white);
        border-radius: 16px;
        padding: 16px 24px;
        border: 1px solid var(--gray-200);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
    }

    .filter-form {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 600;
        color: var(--gray-600);
    }

    .filter-group input[type="date"] {
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid var(--gray-200);
        font-family: inherit;
        font-size: 13px;
        color: var(--gray-800);
        outline: none;
    }

    .filter-group input[type="date"]:focus {
        border-color: #0c73be;
    }

    .btn-filter {
        padding: 9px 20px;
        border-radius: 30px;
        background: #0c73be;
        color: var(--white);
        border: none;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        font-family: inherit;
    }

    .btn-filter:hover { background: #0b4a99; }

    .summary-badge {
        font-size: 13.5px;
        font-weight: 500;
        color: var(--gray-600);
    }

    .summary-badge span {
        font-weight: 800;
        color: #15803d;
    }

    /* ─── DATA TABLE CARD ─── */
    .table-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.03);
        overflow: hidden;
    }

    table { width: 100%; border-collapse: collapse; }
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
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--gray-50); }

    .time-col { color: var(--gray-400); font-size: 13px; }
    .sj-badge {
        font-weight: 700;
        color: var(--navy);
        background: var(--gray-100);
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12.5px;
    }
    .book-title { font-weight: 600; color: var(--gray-800); }
    .qty-text { font-weight: 700; color: #0c73be; }
    .empty-state { text-align: center; padding: 40px; color: var(--gray-400); }

    @media (max-width: 768px) {
        .filter-card { flex-direction: column; align-items: stretch; gap: 16px; }
        .filter-form { flex-direction: column; align-items: stretch; }
        .filter-group { justify-content: space-between; }
        .btn-filter { width: 100%; text-align: center; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Histori Laporan Distribusi</h1>
    <p>Pantau rekaman mutasi logistik barang dan penerbitan Surat Jalan (SJ) ke cabang.</p>
</div>

<div class="filter-card">
    <div class="filter-form">
        <form method="GET" action="{{ route('pusat.laporan.distribusi') }}" class="filter-form">
            <div class="filter-group">
                <label>Dari</label>
                <input type="date" name="tgl_mulai" value="{{ $tgl_mulai }}">
            </div>
            <div class="filter-group">
                <label>Sampai</label>
                <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}">
            </div>
            <button type="submit" class="btn-filter">Filter Laporan</button>
        </form>
    </div>
    <div class="summary-badge">
        Total Buku Dikirim: <span>{{ number_format($total_buku_dikirim, 0, ',', '.') }} Unit</span>
    </div>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width: 18%;">Waktu Kirim</th>
                <th style="width: 22%;">Nomor Surat Jalan</th>
                <th style="width: 45%;">Judul Buku</th>
                <th style="width: 15%;">Jumlah (Qty)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($distribusi as $item)
            <tr>
                <td><span class="time-col">{{ date('d/m/Y H:i', strtotime($item->waktu)) }}</span></td>
                <td><span class="sj-badge">{{ $item->keterangan }}</span></td>
                <td><span class="book-title">{{ $item->buku->judul ?? 'Buku Dihapus' }}</span></td>
                <td><span class="qty-text">{{ $item->qty }} Unit</span></td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">Tidak ada data pengiriman pada rentang tanggal tersebut.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
