@extends('layouts.admin')

@section('title', 'Kirim Distribusi Buku — SPBT Admin')

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

        /* ─── TWO PANELS SPLIT LAYOUT ─── */
        .distribution-grid {
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ─── FORM CARD COMPONENT ─── */
        .form-card {
            background: var(--white);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 12px rgba(26, 46, 90, 0.03);
        }

        .form-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--gray-100);
        }

        .form-group {
            margin-bottom: 18px;
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
            padding: 12px 16px;
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

        .btn-submit {
            width: 100%;
            padding: 12px;
            border-radius: 30px;
            font-size: 13.5px;
            font-weight: 600;
            border: none;
            background: #0c73be;
            color: var(--white);
            cursor: pointer;
            font-family: 'Plus Jakarta Sans', sans-serif;
            box-shadow: 0 4px 10px rgba(12, 115, 190, 0.15);
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 8px;
        }

        .btn-submit:hover {
            background: #0b4a99;
        }

        /* ─── HISTORY TABLE CARD ─── */
        .table-card {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 12px rgba(26, 46, 90, 0.03);
            overflow: hidden;
        }

        .table-title {
            font-size: 15px;
            font-weight: 700;
            color: var(--gray-800);
            padding: 20px 24px;
            background: var(--white);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 12px 24px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            color: var(--gray-400);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-100);
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

        .book-id-badge {
            font-weight: 600;
            color: var(--gray-600);
        }

        .qty-out {
            font-weight: 700;
            color: var(--red);
        }

        /* ─── NOTIFICATION BOX ─── */
        .alert-box {
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 16px;
            font-size: 13.5px;
            font-weight: 600;
        }

        .alert-box.success {
            background: var(--green-bg);
            color: #15803d;
            border: 1px solid rgba(34, 197, 94, 0.15);
        }

        .alert-box.error {
            background: var(--red-bg);
            color: #b91c1c;
            border: 1px solid rgba(239, 68, 68, 0.15);
        }

        @media (max-width: 1024px) {
            .distribution-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <h1>Kirim Barang ke Cabang</h1>
        <p>Kelola mutasi stock outbound dari gudang pusat ke armada ekspedisi cabang SPBT.</p>
    </div>

    @if (session('success'))
        <div class="alert-box success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert-box error">{{ session('error') }}</div>
    @endif

    <div class="distribution-grid">

        {{-- SISI KIRI: FORM PENGIRIMAN --}}
        <div class="form-card">
            <div class="form-title">Form Kirim Distribusi</div>
            <form action="{{ route('pusat.distribusi.kirim') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="buku_id">Pilih Buku Koleksi</label>
                    <select name="buku_id" id="buku_id" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach ($buku as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->buku->judul ?? 'Data Buku Dihapus' }} (Stok: {{ $item->qty_tersedia }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Pilih Tujuan Cabang:</label>
                    <select name="cabang_id" required style="width: 100%; padding: 10px; margin-bottom: 15px;">
                        <option value="">-- Pilih Cabang --</option>
                        @foreach ($daftarCabang as $cabang)
                            <option value="{{ $cabang->id }}">{{ $cabang->nama_cabang }} - {{ $cabang->lokasi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="qty">Jumlah Kirim (Qty)</label>
                    <input type="number" name="qty" id="qty" min="1" placeholder="Masukkan jumlah eks"
                        required>
                </div>

                <button type="submit" class="btn-submit">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                    Kirim ke Ekspedisi
                </button>
            </form>
        </div>

        {{-- SISI KANAN: TABEL LOG MUTASI KELUAR --}}
        <div class="table-card">
            <div class="table-title">Catatan Pengiriman (Mutasi Keluar)</div>
            <table>
                <thead>
                    <tr>
                        <th>No. Referensi (SJ)</th>
                        <th>ID Buku</th>
                        <th>Qty Keluar</th>
                        <th>Waktu Kirim</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengiriman as $item)
                        <tr>
                            <td><span class="ref-sj">{{ $item->keterangan }}</span></td>
                            <td><span class="book-id-badge">Buku ID #{{ $item->buku_id }}</span></td>
                            <td><span class="qty-out">-{{ $item->qty }} Eks</span></td>
                            <td><span style="color: var(--gray-600);">{{ $item->waktu }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

@endsection
