<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Buku;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function laporanPenjualan(Request $request)
    {
        $tgl_mulai = $request->input('tgl_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tgl_akhir = $request->input('tgl_akhir', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $transaksi = Transaksi::query()
            ->where('status_pembayaran', 'SUKSES')
            ->whereBetween('created_at', [$tgl_mulai . ' 00:00:00', $tgl_akhir . ' 23:59:59'])
            ->orderBy('created_at', 'desc')
            ->get();

        $total_omzet = $transaksi->sum('total');
        $omzet_online = $transaksi->where('tipe_pesanan', 'ONLINE')->sum('total');
        $omzet_offline = $transaksi->where('tipe_pesanan', 'OFFLINE')->sum('total');
        $total_transaksi = $transaksi->count();

        return view('admin_cabang.laporan_penjualan', compact(
            'transaksi', 'tgl_mulai', 'tgl_akhir', 'total_omzet', 'omzet_online', 'omzet_offline', 'total_transaksi'
        ));
    }

    public function bukuTerlaris(Request $request)
    {
        $tgl_mulai = $request->input('tgl_mulai', Carbon::now()->startOfMonth()->format('Y-m-d'));
        $tgl_akhir = $request->input('tgl_akhir', Carbon::now()->endOfMonth()->format('Y-m-d'));

        $id_transaksi_sukses = Transaksi::query()
            ->where('status_pembayaran', 'SUKSES')
            ->whereBetween('created_at', [$tgl_mulai . ' 00:00:00', $tgl_akhir . ' 23:59:59'])
            ->pluck('id');

        $buku_terlaris = DetailTransaksi::query()
            ->select('buku_id', DB::raw('SUM(qty) as total_qty'), DB::raw('SUM(subtotal) as total_pendapatan'))
            ->whereIn('transaksi_id', $id_transaksi_sukses)
            ->groupBy('buku_id')
            ->orderByDesc('total_qty')
            ->limit(10)
            ->get();

        foreach($buku_terlaris as $item) {
            $item->buku = Buku::query()->find($item->buku_id);
        }

        return view('admin_cabang.laporan_terlaris', compact('buku_terlaris', 'tgl_mulai', 'tgl_akhir'));
    }
}
