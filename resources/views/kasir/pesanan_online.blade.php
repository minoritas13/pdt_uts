@extends('layouts.kasir')

@section('title', 'Pesanan Online Kasir — SPBT Admin')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        gap: 16px;
    }
    .page-header h1 { font-size: 22px; font-weight: 800; color: var(--gray-800); }
    .page-header p  { font-size: 13.5px; color: var(--gray-400); margin-top: 2px; }

    .btn-pos-nav {
        padding: 10px 20px;
        border-radius: 30px;
        font-size: 13px;
        font-weight: 600;
        border: 1.5px solid var(--gray-200);
        background: var(--white);
        color: var(--gray-600);
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-pos-nav:hover { border-color: var(--navy); color: var(--navy); }

    /* ─── DATA TABLE CARD COMPONENT ─── */
    .table-card {
        background: var(--white);
        border-radius: 16px;
        border: 1px solid var(--gray-200);
        box-shadow: 0 4px 12px rgba(26, 46, 90, 0.02);
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
        padding: 16px 24px;
        font-size: 13.5px;
        color: var(--gray-800);
        border-bottom: 1px solid var(--gray-100);
        vertical-align: middle;
    }
    tr:last-child td { border-bottom: none; }
    tr:hover td { background: var(--gray-50); }

    .struk-id { font-weight: 700; color: var(--navy); }
    .amount-text { font-weight: 700; color: var(--gray-800); }

    /* Thumbnail Bukti Potongan Gambar Premium */
    .proof-thumbnail-box {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        overflow: hidden;
        border: 1px solid var(--gray-200);
        box-shadow: 0 2px 6px rgba(0,0,0,0.04);
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-50);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .proof-thumbnail-box:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .proof-thumbnail-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ─── ACTION BUTTON CAPSULE ─── */
    .btn-acc-submit {
        background: #22c55e;
        color: var(--white);
        border: none;
        padding: 8px 16px;
        border-radius: 30px;
        font-family: inherit;
        font-size: 12.5px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 3px 8px rgba(34, 197, 94, 0.2);
        transition: background 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-acc-submit:hover { background: #16a34a; }

    /* ─── NOTIFICATION BANNER ─── */
    .alert-toast-success {
        background: var(--green-bg);
        color: #15803d;
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        border: 1px solid rgba(34, 197, 94, 0.15);
        font-size: 13.5px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .empty-state { text-align: center; padding: 48px !important; color: var(--gray-400); }

    @media (max-width: 640px) {
        .page-header { flex-direction: column; align-items: flex-start; }
        .btn-pos-nav { width: 100%; text-align: center; }
        th, td { padding: 12px 16px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div>
        <h1>Pesanan Online (Click & Collect)</h1>
        <p>Verifikasi lampiran manifest transfer dana perbankan milik pelanggan untuk penyerahan fisik buku.</p>
    </div>
    <a href="{{ route('kasir.pos') }}" class="btn-pos-nav">Buka Mesin Kasir (Offline)</a>
</div>

@if(session('success'))
    <div class="alert-toast-success">
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
                <th style="width: 25%;">No. Struk Pesanan</th>
                <th style="width: 25%;">Total Bayar Tagihan</th>
                <th style="width: 25%;">Validasi Bukti Transfer</th>
                <th style="width: 25%; text-align: right;">Aksi Kasir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $item)
            <tr>
                <td><span class="struk-id">{{ $item->no_struk }}</span></td>
                <td><span class="amount-text">Rp {{ number_format($item->total, 0, ',', '.') }}</span></td>
                
                <td>
                    <a href="{{ asset('storage/' . $item->bukti_bayar) }}" target="_blank" class="proof-thumbnail-box" title="Klik untuk memperbesar gambar">
                        <img src="{{ asset('storage/' . $item->bukti_bayar) }}" alt="Bukti Kirim Pembayaran">
                    </a>
                </td>

                <td style="text-align: right;">
                    <form action="{{ route('kasir.acc', $item->id) }}" method="POST" onsubmit="return confirm('Apakah dana transfer sudah valid masuk ke rekening? Kuantitas stok rak buku cabang akan terpotong otomatis jika Anda melanjutkan.')">
                        @csrf
                        <button type="submit" class="btn-acc-submit">
                            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                            ACC & Serahkan Barang
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="empty-state">
                    <div style="margin-bottom: 8px;">
                        <svg width="40" height="40" fill="none" stroke="var(--gray-400)" stroke-width="1.5" viewBox="0 0 24 24" style="display: inline-block;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.03 0 1.9.732 2.076 1.704m-12.144 1.2c-.126.046-.25.105-.371.175m11.378-1.378A48.222 48.222 0 0012 3.75c-1.428 0-2.816.062-4.187.183M3.75 6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M3.75 6.108V19.5a2.25 2.25 0 002.25 2.25h1.5M3.75 6.108c.126.046.25.105.371.175M6.75 3.75a48.106 48.106 0 013-.153"/>
                        </svg>
                    </div>
                    Belum ada pesanan online baru yang menunggu konfirmasi di cabang ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
