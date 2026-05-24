@extends('layouts.admin')

@section('title', 'Monitoring Stok Pusat — SPBT Admin')

@push('styles')
<style>
    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 22px; font-weight: 800; color: var(--gray-800); }
    .page-header p  { font-size: 13.5px; color: var(--gray-400); margin-top: 2px; }

    /* ─── KPI METRICS BOARD ─── */
    .kpi-board {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }
    .kpi-card {
        background: var(--white);
        border-radius: 16px;
        padding: 20px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.02);
    }
    .kpi-label { font-size: 12.5px; font-weight: 600; color: var(--gray-400); margin-bottom: 4px; }
    .kpi-value { font-size: 24px; font-weight: 800; color: var(--gray-800); }
    
    /* Peringatan Kritis Otomatis Merah jika ada stok tipis */
    .kpi-card.alert-danger-zone {
        background: var(--red-bg);
        border-color: rgba(239, 68, 68, 0.2);
    }
    .kpi-card.alert-danger-zone .kpi-label { color: #b91c1c; }
    .kpi-card.alert-danger-zone .kpi-value { color: #b91c1c; }

    /* ─── MONITORING TABLE ─── */
    .table-card {
        background: var(--white); border-radius: 16px; border: 1px solid var(--gray-200); box-shadow: 0 4px 12px rgba(26, 46, 90, 0.03); overflow: hidden;
    }
    table { width: 100%; border-collapse: collapse; }
    th {
        padding: 14px 24px; text-align: left; font-size: 11px; font-weight: 700; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.6px; background: var(--gray-50); border-bottom: 1px solid var(--gray-100);
    }
    td { padding: 14px 24px; font-size: 13.5px; color: var(--gray-800); border-bottom: 1px solid var(--gray-100); vertical-align: middle; }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--gray-50); }

    .book-id { font-size: 12.5px; font-weight: 600; color: var(--gray-400); }
    .book-title { font-weight: 700; color: var(--gray-800); }
    .price-text { font-weight: 600; color: var(--gray-600); }
    .qty-display { font-size: 16px; font-weight: 800; }
    
    /* ─── STATUS BADGES ─── */
    .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
    .badge-aman { background: var(--green-bg); color: #15803d; }
    .badge-kritis { background: var(--yellow-bg); color: #a16207; }
    .badge-habis { background: var(--red-bg); color: #b91c1c; }

    @media (max-width: 768px) {
        .kpi-board { grid-template-columns: 1fr; }
        th, td { padding: 12px 16px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Monitoring Stok Gudang Pusat</h1>
    <p>Kelola dan pantau batas minimal ambang keamanan ketersediaan fisik buku.</p>
</div>

<div class="kpi-board">
    <div class="kpi-card">
        <div class="kpi-label">Total Judul Buku</div>
        <div class="kpi-value">{{ $total_judul }} <span style="font-size:14px; font-weight:500; color:var(--gray-400);">Judul</span></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-label">Total Fisik Buku</div>
        <div class="kpi-value" style="color: #0c73be;">{{ number_format($total_stok_fisik, 0, ',', '.') }} <span style="font-size:14px; font-weight:500; color:var(--gray-400);">Unit</span></div>
    </div>
    <div class="kpi-card {{ $stok_kritis > 0 ? 'alert-danger-zone' : '' }}">
        <div class="kpi-label">Peringatan Stok Kritis</div>
        <div class="kpi-value">{{ $stok_kritis }} <span style="font-size:14px; font-weight:500;">Buku (&lt; 10 Unit)</span></div>
    </div>
</div>

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width: 12%;">ID Buku</th>
                <th style="width: 43%;">Judul Buku</th>
                <th style="width: 20%;">Harga Nasional</th>
                <th style="width: 13%;">Sisa Stok</th>
                <th style="width: 12%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($stokPusat as $item)
            <tr>
                <td><span class="book-id">#{{ $item->buku_id }}</span></td>
                <td><span class="book-title">{{ $item->buku->judul ?? 'Data Buku Dihapus' }}</span></td>
                <td><span class="price-text">Rp {{ number_format($item->buku->harga_nasional ?? 0, 0, ',', '.') }}</span></td>
                
                {{-- Pewarnaan Angka Kuantitas Dinamis --}}
                <td class="qty-display" style="color: {{ $item->qty_tersedia < 10 ? '#b91c1c' : '#15803d' }};">
                    {{ $item->qty_tersedia }}
                </td>

                <td>
                    @if($item->qty_tersedia == 0)
                        <span class="status-badge badge-habis">HABIS</span>
                    @elseif($item->qty_tersedia < 10)
                        <span class="status-badge badge-kritis">KRITIS</span>
                    @else
                        <span class="status-badge badge-aman">AMAN</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; padding: 32px; color: var(--gray-400);">Belum ada data stok di gudang pusat.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
