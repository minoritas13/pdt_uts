<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\RequestStok;

class RequestCabangController extends Controller
{
    public function index()
    {
        // Tampilkan semua buku yang ada di database pusat untuk dipilih
        $buku = Buku::query()->orderBy('judul')->get();
        
        // Tampilkan histori request dari cabang ini
        $riwayat_request = RequestStok::query()->with('buku')->orderBy('created_at', 'desc')->get();

        return view('admin_cabang.request.index', compact('buku', 'riwayat_request'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required',
            'qty' => 'required|integer|min:1',
        ]);

        RequestStok::query()->create([
            'buku_id' => $request->buku_id,
            'qty' => $request->qty,
            'catatan_cabang' => $request->catatan_cabang,
            'status' => 'PENDING'
        ]);

        return redirect()->back()->with('success', 'Permintaan stok berhasil dikirim ke Pusat! Menunggu persetujuan.');
    }
}