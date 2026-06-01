<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\MutasiGudangPusat;
use App\Models\StokGudangPusat;
use Illuminate\Http\Request;

class DistribusiPusatController extends Controller
{
    public function index()
    {
        $buku = StokGudangPusat::with('buku')->get();

        // Menampilkan histori pengiriman (mutasi KELUAR yang diawali kode SJ-)
        $pengiriman = MutasiGudangPusat::query()
            ->where('jenis', 'KELUAR')
            ->where('keterangan', 'like', 'SJ-%')
            ->orderBy('created_at', 'desc')
            ->get();

        $daftarCabang = Cabang::query()->orderBy('nama_cabang')->get();

        return view('admin.stok.pusat_kirim', compact('buku', 'pengiriman','daftarCabang'));
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

        $no_surat = 'SJ-' . time() . '-' . rand(10, 99);

        $buku->decrement('qty_tersedia', $request->qty);

        MutasiGudangPusat::create([
            'buku_id'    => $buku->id,
            'jenis'      => 'KELUAR',
            'qty'        => $request->qty,
            'keterangan' => $no_surat, // Kunci utama untuk referensi silang
        ]);

        return redirect()->back()->with('success', 'Barang dikirim dengan nomor ' . $no_surat . '! Menunggu diterima Cabang.');
    }
}
