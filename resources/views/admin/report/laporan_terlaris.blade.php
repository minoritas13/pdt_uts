@extends('layouts.branch_admin')

@section('title', 'Top 10 Buku Terlaris — SPBT Admin')

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

    .filter-form { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
    .filter-group { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: var(--gray-600); }
    .filter-group input[type="date"] {
        padding: 8px 16px; border-radius: 30px; border: 1px solid var(--gray-200); font-family: inherit; font-size: 13px; color: var(--gray-800); outline: none;
    }
    .filter-group input[type="date"]:focus { border-color: #0c73be; }
    
    .btn-filter {
        padding: 9px 20px; border-radius: 30px; background: #112c7a; color: var(--white); border: none; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit;
        transition: background 0.2s;
    }
    .btn-filter:hover { background: #0c73be; }

    .btn-back-report {
        padding: 10px 20px; border-radius: 30px; font-size: 13px; font-weight: 600; border: 1.5px solid var(--gray-200); background: var(--white); color: var(--gray-600); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        transition: all 0.2s;
    }
    .btn-back-report:hover { border-color: #112c7a; color: #112c7a; }

    /* ─── DATA TABLE CARD COMPONENT ─── */
    .table-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.03);
        overflow: hidden;
    }

    table { width: 100%; border-collapse: collapse; }
    th {
        padding: 14px 24px; text-align: left; font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.6px; background: var(--gray-50); border-bottom: 1px solid var(--gray-100);
    }
    td { padding: 16px 24px; font-size: 13.5px; color: var(--gray-800); border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--gray-50); }

    /* Lingkaran Badges Ranking Sesuai Urutan */
    .rank-circle-badge {
        display: inline-flex; width: 32px; height: 32px; border-radius: 50%; font-size: 12.5px; font-weight: 800; align-items: center; justify-content: center;
    }
    tr:nth-child(1) .rank-circle-badge { background: #fef9c3; color: #a16207; } /* Rank 1 Emas */
    tr:nth-child(2) .rank-circle-badge { background: #f1f5f9; color: #475569; } /* Rank 2 Perak */
    tr:nth-child(3) .rank-circle-badge { background: #ffedd5; color: #ea580c; } /* Rank 3 Perunggu */
    tr:nth-child(n+4) .rank-circle-badge { background: var(--gray-100); color: var(--gray-600); }

    .book-title-main { font-weight: 700; color: var(--gray-800); }
    .book-author-sub { font-size: 12px; color: var(--gray-400); font-weight: 500; margin-top: 2px; }
    
    .qty-sold-badge { font-weight: 800; color: #0c73be; font-size: 14.5px; }
    .revenue-col-value { font-weight: 700; text-align: right; color: var(--gray-800); }
    .empty-state { text-align: center; padding: 48px !important; color: var(--gray-400); }

    @media (max-width: 768px) {
        .filter-card { flex-direction: column; align-items: stretch; }
        .filter-form { flex-direction: column; align-items: stretch; }
        .btn-filter, .btn-back-report { width: 100%; justify-content: center; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Top 10 Buku Terlaris (Best Seller)</h1>
    <p>Analisis sepuluh peringkat koleksi judul buku dengan volume kuantitas penjualan tertinggi di gerai toko.</p>
</div>

{{-- UTILITY FILTER BAR --}}
<div class="filter-card">
    {{-- PERBAIKAN: Menggunakan url()->current() agar submit filter fleksibel mengikuti rute role pengakses --}}
    <form method="GET" action="{{ url()->current() }}" class="filter-form">
        <div class="filter-group">
            <label>Dari</label>
            <input type="date" name="tgl_mulai" value="{{ $tgl_mulai }}">
        </div>
        <div class="filter-group">
            <label>Sampai</label>
            <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}">
        </div>
        <button type="submit" class="btn-filter">Filter Data</button>
    </form>
    
    {{-- PERBAIKAN LINK KEMBALI: Fleksibel mendeteksi rute kembali berdasarkan role login --}}
    <a href="{{ request()->is('admin-pusat*') ? route('pusat.laporan.penjualan') : route('cabang.laporan.penjualan') }}" class="btn-back-report">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        Kembali ke Laporan Omzet
    </a>
</div>

{{-- RANKING DATA TABLE CARD --}}
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width: 12%; text-align: center;">Peringkat</th>
                <th style="width: 48%;">Informasi Detail Buku</th>
                <th style="width: 20%;">Volume Terjual</th>
                <th style="width: 20%; text-align: right;">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($buku_terlaris as $index => $item)
            <tr>
                <td style="text-align: center;">
                    <div class="rank-circle-badge">#{{ $index + 1 }}</div>
                </td>
                <td>
                    <div class="book-title-main">{{ $item->buku->judul ?? 'Data Buku Telah Dihapus' }}</div>
                    <div class="book-author-sub">by {{ $item->buku->penulis ?? 'Penulis SPBT' }}</div>
                </td>
                <td><span class="qty-sold-badge">{{ number_format($item->total_qty) }} Unit</span></td>
                <td class="revenue-col-value">Rp {{ number_format($item->total_pendapatan, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">Belum ada data transaksi penjualan untuk dianalisis dalam rentang tanggal ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
