<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Cabang;
use App\Models\DetailTransaksi;
use App\Models\Kategori;
use App\Models\MutasiStokLokal;
use App\Models\PelangganLokal;
use App\Models\PelangganNasional;
use App\Models\Penerbit;
use App\Models\RekapHarianNasional;
use App\Models\StokGudangPusat;
use App\Models\StokLokal;
use App\Models\Transaksi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // --- TAHAP 1: DATABASE PUSAT ---
        // 1. Buat Kategori & Penerbit (Master)
        Kategori::factory(10)->create();
        Penerbit::factory(15)->create();

        // 2. Buat 50 Buku di Pusat
        $listBukuPusat = Buku::factory(50)->create();

        // 3. Buat Data Cabang
        $cabangs = Cabang::factory(5)->create();

        // 4. Isi Stok Gudang Pusat untuk setiap buku
        foreach ($listBukuPusat as $buku) {
            StokGudangPusat::create([
                'buku_id' => $buku->id,
                'qty_tersedia' => rand(100, 500)
            ]);
        }


        // --- TAHAP 2: DATABASE CABANG ---
        // 1. Buat Pelanggan di Cabang
         $pelangganLokal = PelangganLokal::factory(30)->create();
        
        foreach ($pelangganLokal as $pelanggan) {
            PelangganNasional::create([
                'nama' => $pelanggan->nama,
                'asal_cabang' => 'Gramedia Lampung', // Sesuai cabang sistem ini
                'created_at' => $pelanggan->created_at,
                'updated_at' => $pelanggan->updated_at,
            ]);
        }

        // 2. Sinkronisasi Katalog ke Stok Lokal
        // Setiap buku di pusat harus punya record stok di cabang agar bisa terjual
        foreach ($listBukuPusat as $buku) {
            StokLokal::create([
                'buku_id' => $buku->id,
                'qty_tersedia' => rand(20, 100)
            ]);
        }

        // 3. Buat 40 Transaksi Penjualan
        for ($i = 0; $i < 40; $i++) {
            $transaksi = Transaksi::factory()->create();
            $totalStruk = 0;

            // Setiap transaksi membeli 1 sampai 4 jenis buku secara acak
            $itemBelanja = $listBukuPusat->random(rand(1, 4));

            foreach ($itemBelanja as $buku) {
                $qty = rand(1, 3);
                $subtotal = $buku->harga_nasional * $qty;

                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'buku_id' => $buku->id,
                    'qty' => $qty,
                    'harga_satuan' => $buku->harga_nasional,
                    'subtotal' => $subtotal
                ]);

                // Catat mutasi stok lokal (KELUAR)
                MutasiStokLokal::create([
                    'buku_id' => $buku->id,
                    'jenis' => 'KELUAR',
                    'qty' => $qty,
                    'keterangan' => "Penjualan Struk " . $transaksi->no_struk,
                    'waktu' => $transaksi->created_at
                ]);

                $totalStruk += $subtotal;
            }

            // Update total belanja di header transaksi
            $transaksi->update(['total' => $totalStruk]);
        }


        // --- TAHAP 3: REKAPITULASI KE PUSAT ---
        // Mengambil data dari cabang untuk mengisi rekap di pusat (Audit PDT)
        $dataCabangTerpilih = $cabangs->first();
        $totalPendapatanCabang = Transaksi::sum('total');
        $jumlahTrx = Transaksi::count();

        RekapHarianNasional::create([
            'cabang_id' => $dataCabangTerpilih->id,
            'tanggal' => now()->toDateString(),
            'total_transaksi' => $jumlahTrx,
            'total_pendapatan' => $totalPendapatanCabang
        ]);
    }
}
