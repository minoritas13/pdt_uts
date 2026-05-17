<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\MutasiGudangPusat;
use App\Models\StokGudangPusat;

class DistribusiPusatController extends Controller
{
    public function index()
    {
        $buku = Buku::query()->get();

        // Menampilkan histori pengiriman (mutasi KELUAR yang diawali kode SJ-)
        $pengiriman = MutasiGudangPusat::query()
            ->where('jenis', 'KELUAR')
            ->where('keterangan', 'like', 'SJ-%')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.stok.pusat_kirim', compact('buku', 'pengiriman'));
    }

    public function kirimBarang(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'qty'     => 'required|integer|min:1'
        ]);

        $buku = StokGudangPusat::query()->findOrFail($request->buku_id);

        if ($buku->qty_tersedia < $request->qty) {
            return redirect()->back()->with('error', 'Stok pusat tidak mencukupi!');
        }

        // Generate Nomor Surat Jalan
        $no_surat = 'SJ-' . time() . '-' . rand(10, 99);

        // 1. Kurangi Stok Pusat
        $buku->decrement('qty_tersedia', $request->qty);

        // 2. Catat Mutasi Pusat dengan Keterangan Nomor Surat Jalan persis
        MutasiGudangPusat::create([
            'buku_id'    => $buku->id,
            'jenis'      => 'KELUAR',
            'qty'        => $request->qty,
            'keterangan' => $no_surat, // Kunci utama untuk referensi silang
        ]);

        return redirect()->back()->with('success', 'Barang dikirim dengan nomor ' . $no_surat . '! Menunggu diterima Cabang.');
    }
}
