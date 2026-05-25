<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\DetailTransaksi;
use App\Models\MutasiStokLokal; // Tambahkan ini
use App\Models\StokLokal;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function mesinPOS()
    {
        // Tampilkan hanya buku yang ADA STOKNYA di cabang ini
        $stokLokal = StokLokal::query()->where('qty_tersedia', '>', 0)->get();

        foreach ($stokLokal as $stok) {
            $stok->buku = Buku::query()->find($stok->buku_id);
        }

        return view('kasir.dashboard', compact('stokLokal'));
    }

    public function prosesPOS(Request $request)
    {
        $request->validate([
            'buku_id'   => 'required|array',
            'buku_id.*' => 'required',
            'qty'       => 'required|array',
            'qty.*'     => 'required|integer|min:1'
        ], [
            'buku_id.required' => 'Keranjang masih kosong, belum ada buku yang dipilih!'
        ]);

        $buku_ids = $request->buku_id;
        $qtys = $request->qty;

        DB::connection('pgsql_cabang')->beginTransaction();

        try {
            $total_bayar = 0;
            $items = [];

            for ($i = 0; $i < count($buku_ids); $i++) {
                $buku = Buku::query()->findOrFail($buku_ids[$i]);
                $subtotal = $buku->harga_nasional * $qtys[$i];
                $total_bayar += $subtotal;

                $cekStok = StokLokal::query()->where('buku_id', $buku->id)->first();
                if (!$cekStok || $cekStok->qty_tersedia < $qtys[$i]) {
                    throw new \Exception("Stok buku '{$buku->judul}' tidak mencukupi!");
                }

                $items[] = [
                    'buku'     => $buku,
                    'qty'      => $qtys[$i],
                    'subtotal' => $subtotal
                ];
            }

            $no_struk = 'POS-' . time() . '-' . rand(10, 99);
            $transaksi = Transaksi::create([
                'no_struk'          => $no_struk,
                'total'             => $total_bayar,
                'status_pembayaran' => 'SUKSES',
                'tipe_pesanan'      => 'OFFLINE',
                'bukti_bayar'       => 'CASH'
            ]);

            foreach ($items as $item) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'buku_id'      => $item['buku']->id,
                    'qty'          => $item['qty'],
                    'harga_satuan' => $item['buku']->harga_nasional,
                    'subtotal'     => $item['subtotal'],
                ]);

                $stok = StokLokal::query()->where('buku_id', $item['buku']->id)->first();
                $stok->decrement('qty_tersedia', $item['qty']);

                // Catat Mutasi
                MutasiStokLokal::create([
                    'buku_id'    => $item['buku']->id,
                    'jenis'      => 'KELUAR',
                    'qty'        => $item['qty'],
                    'keterangan' => 'Penjualan Toko (POS) Struk #' . $no_struk,
                    'waktu'      => now(),
                ]);
            }

            DB::connection('pgsql_cabang')->commit();
            return redirect()->back()->with('success', "Pembayaran Berhasil! No. Struk: {$no_struk}");
        } catch (\Exception $e) {
            DB::connection('pgsql_cabang')->rollBack();
            return redirect()->back()->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }
}
