<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\MutasiGudangPusat;
use App\Models\StokGudangPusat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportPusatController extends Controller
{
    public function laporanStok()
    {
        $stokPusat = StokGudangPusat::with('buku')->orderBy('qty_tersedia', 'asc')->get();

        // Kalkulasi KPI
        $total_judul = $stokPusat->count();
        $total_stok_fisik = $stokPusat->sum('qty_tersedia');
        $stok_kritis = $stokPusat->where('qty_tersedia', '<', 10)->count();

        return view('admin.report.stok_pusat', compact('stokPusat', 'total_judul', 'total_stok_fisik', 'stok_kritis'));
    }

    public function laporanDistribusi(Request $request)
    {
        $tgl_mulai = $request->input('tgl_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tgl_akhir = $request->input('tgl_akhir', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $distribusi = MutasiGudangPusat::query()
            ->where('jenis', 'KELUAR')
            ->where('keterangan', 'like', 'SJ-%')
            ->whereBetween('waktu', [$tgl_mulai.' 00:00:00', $tgl_akhir.' 23:59:59'])
            ->orderBy('waktu', 'desc')
            ->get();

        foreach ($distribusi as $item) {
            $item->buku = Buku::query()->find($item->buku_id);
        }

        $total_buku_dikirim = $distribusi->sum('qty');

        return view('admin.report.distribusi', compact('distribusi', 'tgl_mulai', 'tgl_akhir', 'total_buku_dikirim'));
    }

    public function penjualanGlobal(Request $request)
    {
        $tgl_mulai = $request->input('tgl_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tgl_akhir = $request->input('tgl_akhir', Carbon::now()->endOfMonth()->format('Y-m-d'));

        // Cross-Database Query ke pgsql_cabang
        $transaksi = DB::connection('pgsql_cabang')
            ->table('transaksi')
            ->where('status_pembayaran', 'SUKSES')
            ->whereBetween('created_at', [$tgl_mulai.' 00:00:00', $tgl_akhir.' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->get();

        $total_omzet = $transaksi->sum('total');
        $total_transaksi = $transaksi->count();
        $omzet_online = $transaksi->where('tipe_pesanan', 'ONLINE')->sum('total');
        $omzet_offline = $transaksi->where('tipe_pesanan', 'OFFLINE')->sum('total');

        return view('admin.report.penjualan_global', compact(
            'transaksi', 'tgl_mulai', 'tgl_akhir', 'total_omzet', 'total_transaksi', 'omzet_online', 'omzet_offline'
        ));
    }
}
