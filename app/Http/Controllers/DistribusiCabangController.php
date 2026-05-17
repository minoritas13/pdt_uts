<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\MutasiGudangPusat;
use App\Models\MutasiStokLokal;
use App\Models\StokLokal;
// use Illuminate\Http\Request;

class DistribusiCabangController extends Controller
{
    public function index()
    {
        // 1. Ambil semua kode SJ yang SUDAH DITERIMA oleh cabang ini
        $sjDiterima = MutasiStokLokal::query()
            ->where('keterangan', 'like', 'SJ-%')
            ->pluck('keterangan')
            ->toArray();

        // 2. Ambil mutasi dari pusat, TAPI KECUALIKAN yang kodenya sudah ada di cabang
        $pengirimanDiJalan = MutasiGudangPusat::query()
            ->where('jenis', 'KELUAR')
            ->where('keterangan', 'like', 'SJ-%')
            ->whereNotIn('keterangan', $sjDiterima) // Filter barang yang belum sampai
            ->get();

        // 3. Kita butuh manual join ke data Buku karena beda database
        foreach ($pengirimanDiJalan as $mutasi) {
            $mutasi->buku = Buku::query()->find($mutasi->buku_id);
        }

        return view('admin.stok.cabang_terima', compact('pengirimanDiJalan'));
    }

    public function terimaBarang(string $id)
    {
        // Cari data kiriman dari tabel mutasi pusat
        $kiriman = MutasiGudangPusat::query()->findOrFail($id);

        // Pastikan barang ini belum pernah diterima sebelumnya (double submit prevention)
        $cekDiterima = MutasiStokLokal::query()->where('keterangan', $kiriman->keterangan)->exists();
        if ($cekDiterima) {
            return redirect()->back()->with('error', 'Barang ini sudah pernah diterima!');
        }

        // 1. Tambah Stok Cabang (Otomatis buat baru jika belum pernah ada di rak)
        $stokCabang = StokLokal::query()->firstOrCreate(
            ['buku_id' => $kiriman->buku_id],
            ['qty_tersedia' => 0]
        );

        $stokCabang->increment('qty_tersedia', $kiriman->qty);

        // 2. Catat Mutasi Cabang dengan kode SJ yang SAMA PERSIS
        MutasiStokLokal::create([
            'buku_id'    => $kiriman->buku_id,
            'jenis'      => 'MASUK',
            'qty'        => $kiriman->qty,
            'keterangan' => $kiriman->keterangan, // Salin kode SJ-xxxx
        ]);

        return redirect()->back()->with('success', 'Barang diterima! Stok rak cabang telah diperbarui.');
    }
}
