<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Online</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; }
        .payment-container { max-width: 500px; margin: 0 auto; background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #eee; padding-bottom: 15px; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #333; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 16px; }
        .total-price { font-size: 24px; font-weight: bold; color: #d9534f; text-align: center; margin: 20px 0; }
        .qr-box { border: 2px dashed #007bff; background: #f8f9fa; padding: 20px; text-align: center; border-radius: 8px; margin-bottom: 20px; }
        .qr-box img { width: 150px; height: 150px; margin-bottom: 10px; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 5px; }
        .form-group input[type="file"] { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; background: #fafafa; }
        .btn-submit { background-color: #007bff; color: white; width: 100%; padding: 12px; border: none; border-radius: 4px; font-size: 16px; font-weight: bold; cursor: pointer; margin-top: 10px; }
        .btn-submit:hover { background-color: #0056b3; }
        .text-danger { color: red; font-size: 14px; display: block; margin-top: 5px; }
    </style>
</head>
<body>

    <div class="payment-container">
        <div class="header">
            <h2>Selesaikan Pembayaran</h2>
            <p style="color: #666; margin-top: 5px;">Selesaikan pembayaran agar pesanan bisa disiapkan.</p>
        </div>

        <div class="info-row">
            <span>No. Pesanan:</span>
            <strong>{{ $transaksi->no_struk }}</strong>
        </div>
        <div class="info-row">
            <span>Tipe Pesanan:</span>
            <strong>Ambil di Toko (Click & Collect)</strong>
        </div>

        <div class="total-price">
            Rp {{ number_format($transaksi->total, 0, ',', '.') }}
        </div>

        <div class="qr-box">
            <h4 style="margin-top: 0;">Scan QRIS Berikut</h4>
            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" alt="QRIS Dummy">
            <p style="margin-bottom: 0;">Atau Transfer Bank:<br><strong>BCA: 1234 5678 90</strong> a.n. Toko Buku Pusat</p>
        </div>

        <form action="{{ route('checkout.upload', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="bukti_bayar">Upload Bukti Transfer</label>
                <input type="file" name="bukti_bayar" id="bukti_bayar" accept="image/png, image/jpeg, image/jpg" required>
                @error('bukti_bayar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-submit">Kirim Bukti Pembayaran</button>
        </form>

    </div>

</body>
</html>
