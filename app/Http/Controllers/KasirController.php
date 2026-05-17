<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\StokLokal;
use App\Models\MutasiStokLokal; // Tambahkan ini
use App\Models\Buku;

class KasirController extends Controller
{

    public function pesananOnline()
    {
        $transaksi = Transaksi::query()->where('tipe_pesanan', 'ONLINE')
                              ->where('status_pembayaran', 'PENDING')
                              ->whereNotNull('bukti_bayar')
                              ->get();

        return view('kasir.pesanan_online', compact('transaksi'));
    }

    public function accPesananOnline(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // 1. Ubah status menjadi SUKSES
        $transaksi->update(['status_pembayaran' => 'SUKSES']);

        // 2. Ambil detail buku yang dibeli
        $details = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();

        foreach ($details as $item) {
            // Cari stok buku tersebut di cabang
            $stok = StokLokal::where('buku_id', $item->buku_id)->first();

            if ($stok) {
                // PERBAIKAN: Panggil decrement langsung pada instance $stok
                $stok->decrement('qty_tersedia', $item->qty);

                // 3. Catat ke Tabel Mutasi
                MutasiStokLokal::create([
                    'buku_id'    => $item->buku_id,
                    'jenis'      => 'KELUAR',
                    'qty'        => $item->qty,
                    'keterangan' => 'Penjualan Online Struk #' . $transaksi->no_struk,
                    'waktu'      => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Transaksi ' . $transaksi->no_struk . ' di-ACC! Stok berkurang dan mutasi tercatat.');
    }

    public function prosesPOS(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'qty'     => 'required|integer|min:1'
        ]);

        $buku = Buku::findOrFail($request->buku_id);
        $total = $buku->harga_nasional * $request->qty;

        // 1. Simpan Transaksi
        $transaksi = Transaksi::create([
            'no_struk'          => 'POS-' . time() . '-' . rand(10, 99),
            'total'             => $total,
            'status_pembayaran' => 'SUKSES',
            'tipe_pesanan'      => 'OFFLINE',
            'bukti_bayar'       => 'CASH'
        ]);

        // 2. Simpan Detail
        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'buku_id'      => $buku->id,
            'qty'          => $request->qty,
            'harga_satuan' => $buku->harga_nasional,
            'subtotal'     => $total,
        ]);

        // 3. Potong Stok & Catat Mutasi
        $stok = StokLokal::where('buku_id', $buku->id)->first();
        if ($stok) {
            // Potong stok
            $stok->decrement('qty_tersedia', $request->qty);

            // Catat mutasi
            MutasiStokLokal::create([
                'buku_id'    => $buku->id,
                'jenis'      => 'KELUAR',
                'qty'        => $request->qty,
                'keterangan' => 'Penjualan Toko (POS) Struk #' . $transaksi->no_struk,
                'waktu'      => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Pembayaran Berhasil! Stok berkurang dan mutasi tercatat.');
    }
}
