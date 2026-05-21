<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Super Admin (Pusat)
        User::query()->create([
            'name'     => 'Andi Pusat',
            'email'    => 'admin@pusat.com',
            'password' => Hash::make('password123'),
            'role'     => 'SUPER_ADMIN',
        ]);

        // 2. Akun Admin Cabang
        User::query()->create([
            'name'     => 'Budi Cabang',
            'email'    => 'admin@cabang.com',
            'password' => Hash::make('password123'),
            'role'     => 'ADMIN_CABANG',
        ]);

        // 3. Akun Kasir
        User::query()->create([
            'name'     => 'Siti Kasir',
            'email'    => 'kasir@toko.com',
            'password' => Hash::make('password123'),
            'role'     => 'KASIR',
        ]);

        // 4. Akun Pelanggan/User
        User::query()->create([
            'name'     => 'Eko Pelanggan',
            'email'    => 'eko@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'PELANGGAN',
        ]);
    }
}