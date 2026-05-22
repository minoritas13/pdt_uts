<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DistribusiCabangController;
use App\Http\Controllers\DistribusiPusatController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportPusatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rute Publik (Bisa diakses tanpa login)
Route::get('/', function () { return view('welcome'); });

// Rute Autentikasi (Guest / Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.proses');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.proses');
});

// Rute Logout (Harus login dulu baru bisa logout)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// ==========================================
// PROTECTED ROUTES (WAJIB LOG IN)
// ==========================================

// 1. PREFIX: ADMIN PUSAT (Hanya SUPER_ADMIN)
Route::prefix('admin-pusat')->middleware(['auth', 'role:SUPER_ADMIN'])->group(function () {
    Route::resource('buku', BukuController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('user', UserController::class);

    Route::get('/distribusi', [DistribusiPusatController::class, 'index'])->name('pusat.distribusi');
    Route::post('/distribusi/kirim', [DistribusiPusatController::class, 'kirimBarang'])->name('pusat.distribusi.kirim');

    Route::get('/laporan/stok', [ReportPusatController::class, 'laporanStok'])->name('pusat.laporan.stok');
    Route::get('/laporan/distribusi', [ReportPusatController::class, 'laporanDistribusi'])->name('pusat.laporan.distribusi');
    Route::get('/laporan/penjualan', [ReportPusatController::class, 'penjualanGlobal'])->name('pusat.laporan.penjualan');
});

// 2. PREFIX: ADMIN CABANG (Hanya ADMIN_CABANG)
Route::prefix('admin-cabang')->middleware(['auth', 'role:ADMIN_CABANG'])->group(function () {
    Route::get('/penerimaan', [DistribusiCabangController::class, 'index'])->name('cabang.penerimaan');
    Route::post('/penerimaan/terima/{id}', [DistribusiCabangController::class, 'terimaBarang'])->name('cabang.penerimaan.terima');

    Route::get('/laporan/penjualan', [ReportController::class, 'laporanPenjualan'])->name('cabang.laporan.penjualan');
    Route::get('/laporan/buku-terlaris', [ReportController::class, 'bukuTerlaris'])->name('cabang.laporan.terlaris');
});

// 3. PREFIX: KASIR (Hanya KASIR)
Route::prefix('kasir')->middleware(['auth', 'role:KASIR'])->group(function () {
    Route::get('/online', [KasirController::class, 'pesananOnline'])->name('kasir.online');
    Route::post('/online/acc/{id}', [KasirController::class, 'accPesananOnline'])->name('kasir.acc');
    Route::get('/pos', [KasirController::class, 'mesinPOS'])->name('kasir.pos');
    Route::post('/pos/proses', [KasirController::class, 'prosesPOS'])->name('kasir.pos.proses');
});

// 4. PREFIX: USER / PELANGGAN (Hanya PELANGGAN)
Route::prefix('user')->middleware(['auth', 'role:PELANGGAN'])->group(function () {
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
    Route::post('/cart/add/{id}', [KatalogController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [KatalogController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/update', [KatalogController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [KatalogController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/checkout', [CheckoutController::class, 'prosesCheckout'])->name('checkout.proses');
    Route::get('/checkout/bayar/{id}', [CheckoutController::class, 'halamanBayar'])->name('checkout.bayar');
    Route::post('/checkout/upload-bukti/{id}', [CheckoutController::class, 'uploadBukti'])->name('checkout.upload');
});
