<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Cabang; // Pastikan Model Cabang di-import
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. BUAT DATA CABANG TERLEBIH DAHULU
        // ==========================================
        $cabangUtama = Cabang::query()->create([
            'kode_cabang' => 'CBNG-001',
            'nama_cabang' => 'Cabang Jakarta (Utama)',
            'lokasi'      => 'Jakarta Pusat',
        ]);

        $cabangDua = Cabang::query()->create([
            'kode_cabang' => 'CBNG-002',
            'nama_cabang' => 'Cabang Bandung',
            'lokasi'      => 'Bandung Raya',
        ]);

        // ==========================================
        // 2. BUAT AKUN PENGGUNA
        // ==========================================
        // Akun Super Admin (Tidak butuh cabang_id)
        User::query()->create([
            'name'     => 'Andi Pusat',
            'email'    => 'admin@pusat.com',
            'password' => Hash::make('password123'),
            'role'     => 'SUPER_ADMIN',
            'cabang_id'=> null,
        ]);

        // Akun Admin Cabang (Diikat ke Cabang Utama)
        User::query()->create([
            'name'     => 'Budi Cabang',
            'email'    => 'admin@cabang.com',
            'password' => Hash::make('password123'),
            'role'     => 'ADMIN_CABANG',
            'cabang_id'=> $cabangUtama->id, // <-- INI KUNCINYA
        ]);

        // Akun Kasir (Diikat ke Cabang Utama)
        User::query()->create([
            'name'     => 'Siti Kasir',
            'email'    => 'kasir@toko.com',
            'password' => Hash::make('password123'),
            'role'     => 'KASIR',
            'cabang_id'=> $cabangUtama->id, // <-- Kasir juga harus punya cabang
        ]);

        // Akun Pelanggan (Tidak butuh cabang)
        User::query()->create([
            'name'     => 'Eko Pelanggan',
            'email'    => 'eko@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'PELANGGAN',
            'cabang_id'=> null,
        ]);
    }
}
