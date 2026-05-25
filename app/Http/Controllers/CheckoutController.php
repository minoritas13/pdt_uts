<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

class CheckoutController extends Controller
{
    /**
     * Memproses isi keranjang belanja dari session ke database
     */
    public function prosesCheckout(Request $request)
    {
        $cart = session()->get('cart');
        if(!$cart) {
            return redirect()->back()->with('error', 'Keranjang kosong!');
        }

        $total_bayar = 0;
        foreach($cart as $details) {
            $total_bayar += $details['harga'] * $details['quantity'];
        }

        // 1. Simpan Transaksi (Otomatis ditandai sebagai pesanan ONLINE dan PENDING)
        $transaksi = Transaksi::create([
            'no_struk'          => 'TRX-' . time() . '-' . rand(10, 99),
            'total'             => $total_bayar,
            'status_pembayaran' => 'PENDING',
            'tipe_pesanan'      => 'ONLINE',
        ]);

        // 2. Simpan Detail Belanjaan
        foreach($cart as $id => $details) {
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'buku_id'      => $id,
                'qty'          => $details['quantity'],
                'harga_satuan' => $details['harga'],
                'subtotal'     => $details['harga'] * $details['quantity'],
            ]);
        }

        session()->forget('cart');
        return redirect()->route('checkout.bayar', $transaksi->id);
    }

    /**
     * Menampilkan halaman instruksi pembayaran dan form upload bukti
     */
    public function halamanBayar(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('user.payment', compact('transaksi'));
    }

    /**
     * Menyimpan foto bukti transfer yang diunggah pelanggan
     */
    public function uploadBukti(Request $request, string $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Simpan foto ke folder storage/app/public/bukti_bayar
        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        // Update foto buktinya saja (status tetap PENDING agar di-ACC kasir)
        $transaksi->update([
            'bukti_bayar' => $path
        ]);

        return redirect()->route('katalog.index')->with('success', 'Bukti berhasil diupload. Silakan datang ke kasir untuk mengambil buku Anda!');
    }
}
