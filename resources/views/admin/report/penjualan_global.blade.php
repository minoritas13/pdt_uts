@extends(request()->is('admin-pusat*') ? 'layouts.admin' : 'layouts.branch_admin')

@section('title', 'Laporan Penjualan Global — SPBT Admin')

@push('styles')
<style>
    .page-header { margin-bottom: 24px; }
    .page-header h1 { font-size: 22px; font-weight: 800; color: var(--gray-800); }
    .page-header p  { font-size: 13.5px; color: var(--gray-400); margin-top: 2px; }

    /* ─── FILTER CONTAINER ─── */
    .filter-card {
        background: var(--white);
        border-radius: 16px;
        padding: 16px 24px;
        border: 1px solid var(--gray-200);
        margin-bottom: 24px;
    }
    .filter-form { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; }
    .filter-group { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: var(--gray-600); }
    .filter-group input[type="date"] {
        padding: 8px 16px; border-radius: 30px; border: 1px solid var(--gray-200); font-family: inherit; font-size: 13px; color: var(--gray-800); outline: none;
    }
    .btn-filter {
        padding: 9px 20px; border-radius: 30px; background: #0c73be; color: var(--white); border: none; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit;
    }

    /* ─── KPI METRICS CARD ─── */
    .kpi-board {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }
    .kpi-card {
        background: var(--white);
        border-radius: 16px;
        padding: 24px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.02);
    }
    .kpi-card.highlight {
        background: var(--navy);
        border-color: var(--navy);
        color: var(--white);
    }
    .kpi-label { font-size: 12.5px; font-weight: 600; color: var(--gray-400); margin-bottom: 6px; }
    .kpi-card.highlight .kpi-label { color: rgba(255, 255, 255, 0.6); }
    .kpi-value { font-size: 24px; font-weight: 800; color: var(--gray-800); }
    .kpi-card.highlight .kpi-value { color: var(--white); }
    .kpi-sub { font-size: 11.5px; font-weight: 500; color: var(--gray-400); margin-top: 4px; }
    .kpi-card.highlight .kpi-sub { color: rgba(255, 255, 255, 0.4); }

    /* ─── DATA TABLE ─── */
    .section-title { font-size: 15px; font-weight: 700; color: var(--gray-800); margin-bottom: 14px; }
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

    .time-text { color: var(--gray-400); font-size: 13px; }
    .struk-badge { font-weight: 700; color: var(--gray-800); }
    .type-col { font-weight: 600; color: var(--navy-light); }
    .total-col { font-weight: 700; text-align: right; color: var(--gray-800); }

    @media (max-width: 900px) {
        .kpi-board { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <h1>Laporan Omzet Keseluruhan</h1>
    <p>Pantau rincian akumulasi omzet penjualan komparatif dari POS kasir offline maupun online.</p>
</div>

<div class="filter-card">
    <form method="GET" action="{{ url()->current() }}" class="filter-form">
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

<div class="kpi-board">
    <div class="kpi-card highlight">
        <div class="kpi-label">Total Omzet Keseluruhan</div>
        <div class="kpi-value">Rp {{ number_format($total_omzet, 0, ',', '.') }}</div>
        <div class="kpi-sub">Dari {{ $total_transaksi }} Transaksi Terdata</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-label">Omzet POS (Kasir Offline)</div>
        <div class="kpi-value" style="color: #15803d;">Rp {{ number_format($omzet_offline, 0, ',', '.') }}</div>
        <div class="kpi-sub">Penjualan fisik rak cabang</div>
    </div>
    <div class="kpi-card">
        <div class="kpi-label">Omzet Pelanggan Online</div>
        <div class="kpi-value" style="color: #0c73be;">Rp {{ number_format($omzet_online, 0, ',', '.') }}</div>
        <div class="kpi-sub">Pembelian digital web platform</div>
    </div>
</div>

<div class="section-title">Rincian Transaksi Cabang</div>
<div class="table-card">
    <table>
        <thead>
            <tr>
                <th style="width: 20%;">Waktu Transaksi</th>
                <th style="width: 25%;">No. Struk</th>
                <th style="width: 35%;">Tipe Pembelian</th>
                <th style="width: 20%; text-align: right;">Total Bayar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $trx)
            <tr>
                <td><span class="time-text">{{ date('d/m/Y H:i', strtotime($trx->created_at)) }}</span></td>
                <td><span class="struk-badge">{{ $trx->no_struk }}</span></td>
                <td><span class="type-col">{{ $trx->tipe_pesanan }}</span></td>
                <td class="total-col">Rp {{ number_format($trx->total, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align: center; padding: 32px; color: var(--gray-400);">Belum ada data penjualan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
