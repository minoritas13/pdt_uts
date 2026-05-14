<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\StokLokal;
use App\Models\Buku;

class KasirController extends Controller
{
    // =================================================================
    // FITUR 1: AMBIL BARANG (MENGELOLA PESANAN ONLINE DARI PELANGGAN)
    // =================================================================

    /**
     * Menampilkan daftar pesanan online yang sudah ada bukti transfernya
     */
    public function pesananOnline()
    {
        $transaksi = Transaksi::query()->where('tipe_pesanan', 'ONLINE')
                              ->where('status_pembayaran', 'PENDING')
                              ->whereNotNull('bukti_bayar')
                              ->get();

        return view('kasir.pesanan_online', compact('transaksi'));
    }

    /**
     * Mengeksekusi ACC, mengubah status jadi SUKSES, dan memotong stok
     */
    public function accPesananOnline(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // 1. Ubah status menjadi SUKSES
        $transaksi->update(['status_pembayaran' => 'SUKSES']);

        // 2. Potong stok di cabang karena barang diserahkan ke pelanggan
        $details = DetailTransaksi::query()->where('transaksi_id', $transaksi->id)->get();
        foreach ($details as $item) {
            $stok = StokLokal::query()->where('buku_id', $item->buku_id)->first();
            if ($stok) {
                $stok->query()->decrement('qty_tersedia', $item->qty);
            }
        }

        return redirect()->back()->with('success', 'Transaksi ' . $transaksi->no_struk . ' di-ACC! Silakan serahkan barang ke pelanggan.');
    }

    // =================================================================
    // FITUR 2: MESIN POS (MENGELOLA PEMBELIAN OFFLINE LANGSUNG DI TOKO)
    // =================================================================

    /**
     * Menampilkan form mesin kasir cepat
     */
    public function mesinPOS()
    {
        // Menampilkan semua data buku dari db_pusat agar kasir bisa memilih
        $buku = Buku::all();
        return view('kasir.dashboard', compact('buku'));
    }

    /**
     * Memproses pembelian offline, langsung lunas, dan langsung potong stok
     */
    public function prosesPOS(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:pgsql_pusat.buku,id',
            'qty'     => 'required|integer|min:1'
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        $total = $buku->harga_nasional * $request->qty;

        // 1. Simpan Transaksi (Otomatis SUKSES dan OFFLINE)
        $transaksi = Transaksi::create([
            'no_struk'          => 'POS-' . time() . '-' . rand(10, 99),
            'total'             => $total,
            'status_pembayaran' => 'SUKSES',  // Karena bayar tunai di kasir
            'tipe_pesanan'      => 'OFFLINE', // Penanda beli langsung di toko
            'bukti_bayar'       => 'CASH'     // Bukti fisik berupa uang tunai
        ]);

        // 2. Simpan Detail Transaksi
        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'buku_id'      => $buku->id,
            'qty'          => $request->qty,
            'harga_satuan' => $buku->harga_nasional,
            'subtotal'     => $total,
        ]);

        // 3. Potong stok cabang detik itu juga
        $stok = StokLokal::query()->where('buku_id', $buku->id)->first();
        if ($stok) {
            $stok->query()->decrement('qty_tersedia', $request->qty);
        }

        return redirect()->back()->with('success', 'Pembayaran Tunai Berhasil! Stok Terpotong. No Struk: ' . $transaksi->no_struk);
    }
}
