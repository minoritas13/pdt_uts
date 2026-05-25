@extends('layouts.user')

@section('title', 'Selesaikan Pembayaran — SPBT')

@push('styles')
<style>
    .payment-page-container {
        padding: 60px 6% 100px;
        background-color: #f8fafc;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* ─── MODAL CONTAINER (PERSIS DI FOTO) ─── */
    .payment-card {
        background: #ffffff;
        width: 100%;
        max-width: 440px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(17, 44, 122, 0.08);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    /* Header Biru Dongker Premium Utama */
    .card-header-blue {
        background: #112c7a;
        padding: 18px 24px;
        color: #ffffff;
        text-align: center;
        position: relative;
    }

    .card-header-blue h2 {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
        letter-spacing: 0.3px;
    }

    /* Konten Box Putih di Dalam */
    .card-body-content {
        padding: 24px 30px 32px;
        text-align: center;
    }

    /* Timer Hitung Mundur Merah */
    .countdown-timer {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fef2f2;
        color: #ef4444;
        font-size: 11.5px;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 20px;
        margin-bottom: 24px;
        border: 1px solid rgba(239, 68, 68, 0.1);
    }

    /* ─── QR CODE AREA ─── */
    .qr-image-wrapper {
        width: 180px;
        height: 180px;
        margin: 0 auto 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qr-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .payment-label-total {
        font-size: 10.5px;
        font-weight: 700;
        color: #9aa3be;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 4px;
    }

    .payment-grand-amount {
        font-size: 24px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 16px;
    }

    .payment-instruction-text {
        font-size: 12px;
        color: #6b7280;
        line-height: 1.6;
        max-width: 280px;
        margin: 0 auto 24px;
    }

    /* ─── DATA INFO FORM GROUP ─── */
    .info-box-details {
        background: #f8fafc;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 20px;
        text-align: left;
        border: 1px solid #f1f5f9;
    }

    .info-detail-row {
        display: flex;
        justify-content: space-between;
        font-size: 12.5px;
        color: #6b7280;
        margin-bottom: 8px;
    }

    .info-detail-row:last-child {
        margin-bottom: 0;
    }

    .info-detail-row strong {
        color: #1e293b;
        font-weight: 700;
    }

    .form-group-upload {
        text-align: left;
        margin-bottom: 20px;
    }

    .form-group-upload label {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .form-group-upload input[type="file"] {
        width: 100%;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1.5px dashed #cbd5e1;
        background: #f8fafc;
        font-family: inherit;
        font-size: 12.5px;
        color: #6b7280;
        outline: none;
        cursor: pointer;
    }

    .form-group-upload input[type="file"]:focus {
        border-color: #0c73be;
    }

    /* ─── ACTION CAPSULE BUTTONS ─── */
    .btn-action-yellow {
        width: 100%;
        padding: 12px;
        border-radius: 25px;
        background: #f2b705; /* Warna Kuning persis di Gambar */
        color: #112c7a;
        border: none;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(242, 183, 5, 0.2);
        transition: background 0.2s;
        margin-bottom: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .btn-action-yellow:hover {
        background: #e0aa04;
    }

    .btn-action-outline {
        width: 100%;
        padding: 11px;
        border-radius: 25px;
        background: transparent;
        color: #112c7a;
        border: 1.5px solid #112c7a;
        font-family: inherit;
        font-size: 13.5px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: background 0.2s;
    }

    .btn-action-outline:hover {
        background: rgba(17, 44, 122, 0.04);
    }

    .text-danger-msg {
        color: #ef4444;
        font-size: 11.5px;
        font-weight: 600;
        margin-top: 6px;
        display: block;
    }
</style>
@endpush

@section('content')

<div class="payment-page-container">
    
    <div class="payment-card">
        {{-- Header Topbar Card --}}
        <div class="card-header-blue">
            <h2>Pembayaran QRIS</h2>
        </div>

        {{-- Body Main Content --}}
        <div class="card-body-content">
            
            {{-- Timer Alert Realtime Mockup --}}
            <div class="countdown-timer">
                <i class="fa-regular fa-clock"></i> Berakhir dalam 14:59
            </div>

            {{-- QRIS Image Section --}}
            <div class="qr-image-wrapper">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS QR Code">
            </div>

            <div class="payment-label-total">Total Pembayaran</div>
            <div class="payment-grand-amount">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</div>
            
            <div class="payment-instruction-text">
                Scan kode QR di atas menggunakan aplikasi e-wallet atau mobile banking Anda.
                <p style="margin-top: 8px; font-size: 11px; border-top: 1px dashed #e2e8f0; padding-top: 8px;">
                    Atau Transfer Bank:<br><strong>BCA: 1234 5678 90</strong><br>a.n. Toko Buku Pusat
                </p>
            </div>

            {{-- Informasi Lembar Detail Struk Manifest --}}
            <div class="info-box-details">
                <div class="info-detail-row">
                    <span>No. Pesanan:</span>
                    <strong>{{ $transaksi->no_struk }}</strong>
                </div>
                <div class="info-detail-row">
                    <span>Tipe Pesanan:</span>
                    <strong>Ambil di Toko (Click & Collect)</strong>
                </div>
            </div>

            {{-- Form Upload Bukti Fisik Transaksi --}}
            <form action="{{ route('checkout.upload', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group-upload">
                    <label for="bukti_bayar">Upload Bukti Transfer</label>
                    <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/png, image/jpeg, image/jpg" required>
                    @error('bukti_bayar')
                        <span class="text-danger-msg">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tombol Utama Kapsul Kirim Pembayaran --}}
                <button type="submit" class="btn-action-yellow">
                    <i class="fa-solid fa-receipt"></i> Kirim Bukti Pembayaran
                </button>
            </form>

            {{-- Tombol Pendukung Unduh File QR --}}
            <a href="#" class="btn-action-outline" onclick="window.print(); return false;">
                <i class="fa-solid fa-download"></i> Unduh QR
            </a>

        </div>
    </div>

</div>

@endsection
