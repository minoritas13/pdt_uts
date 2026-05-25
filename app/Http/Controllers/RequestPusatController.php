<?php

namespace App\Http\Controllers;

use App\Models\MutasiGudangPusat;
use App\Models\RequestStok;
use App\Models\StokGudangPusat;
use Illuminate\Http\Request;

class RequestPusatController extends Controller
{
    public function index()
    {
        // Panggil relasi 'buku' DAN 'stokPusat' sekaligus
        $permintaan = RequestStok::query()
            ->with(['buku', 'stokPusat'])
            ->where('status', 'PENDING')
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('admin_pusat.request.index', compact('permintaan'));
    }

    public function proses(Request $request, string $id)
    {
        $reqStok = RequestStok::query()->findOrFail($id);
        $aksi = $request->input('aksi'); // 'TERIMA' atau 'TOLAK'

        if ($aksi == 'TOLAK') {
            $reqStok->update(['status' => 'DITOLAK']);
            return redirect()->back()->with('success', 'Permintaan stok dari cabang telah ditolak.');
        }

        // JIKA DITERIMA: Ambil data dari tabel StokGudangPusat
        $stokPusat = StokGudangPusat::query()->where('buku_id', $reqStok->buku_id)->first();

        // Validasi ganda: Pastikan stok benar-benar ada dan cukup
        if (!$stokPusat || $stokPusat->qty_tersedia < $reqStok->qty) {
            return redirect()->back()->with('error', 'Gagal! Sisa stok fisik di gudang pusat tidak mencukupi untuk memenuhi permintaan ini.');
        }

        // 1. Kurangi Stok Fisik Gudang Pusat
        $stokPusat->decrement('qty_tersedia', $reqStok->qty);

        // 2. Buat Surat Jalan (Catat di Mutasi Pusat)
        $no_surat = 'SJ-REQ-' . time() . '-' . rand(10, 99);
        MutasiGudangPusat::create([
            'buku_id'    => $reqStok->buku_id,
            'jenis'      => 'KELUAR',
            'qty'        => $reqStok->qty,
            'keterangan' => $no_surat, 
        ]);

        // 3. Ubah status Request menjadi DIKIRIM
        $reqStok->update(['status' => 'DIKIRIM']);

        return redirect()->back()->with('success', 'Permintaan disetujui! Barang telah dikirim dengan nomor Surat Jalan: ' . $no_surat);
    }
}