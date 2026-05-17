<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DistribusiCabangController;
use App\Http\Controllers\DistribusiPusatController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); // Halaman Landing Page
});

// Semua URL di dalam sini akan diawali dengan /admin-pusat/
Route::prefix('admin-pusat')->group(function () {

    // Kelola Master Data
    Route::resource('buku', BukuController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::get('/distribusi', [DistribusiPusatController::class, 'index'])->name('pusat.distribusi');
    Route::post('/distribusi/kirim', [DistribusiPusatController::class, 'kirimBarang'])->name('pusat.distribusi.kirim');

});

// Semua URL di dalam sini akan diawali dengan /admin-cabang/
Route::prefix('admin-cabang')->group(function () {

    // Rute untuk Admin Cabang (Bisa Anda isi nanti)
    // Contoh:
    // Route::get('/stok', [StokLokalController::class, 'index'])->name('stok.index');
    // Route::get('/mutasi', [MutasiController::class, 'index'])->name('mutasi.index');

    Route::get('/penerimaan', [DistribusiCabangController::class, 'index'])->name('cabang.penerimaan');
    Route::post('/penerimaan/terima/{id}', [DistribusiCabangController::class, 'terimaBarang'])->name('cabang.penerimaan.terima');

});

// Semua URL di dalam sini akan diawali dengan /kasir/
Route::prefix('kasir')->group(function () {

    // Manajemen Pesanan Online (Click & Collect)
    Route::get('/online', [KasirController::class, 'pesananOnline'])->name('kasir.online');
    Route::post('/online/acc/{id}', [KasirController::class, 'accPesananOnline'])->name('kasir.acc');

    // Mesin Kasir Offline (POS)
    Route::get('/pos', [KasirController::class, 'mesinPOS'])->name('kasir.pos');
    Route::post('/pos/proses', [KasirController::class, 'prosesPOS'])->name('kasir.pos.proses');

});

// Semua URL di dalam sini akan diawali dengan /user/
Route::prefix('user')->group(function () {

    // Katalog Buku
    Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');

    // Keranjang Belanja
    Route::post('/cart/add/{id}', [KatalogController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [KatalogController::class, 'showCart'])->name('cart.show');
    Route::post('/cart/update', [KatalogController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [KatalogController::class, 'removeFromCart'])->name('cart.remove');

    // Checkout & Pembayaran
    Route::post('/checkout', [CheckoutController::class, 'prosesCheckout'])->name('checkout.proses');
    Route::get('/checkout/bayar/{id}', [CheckoutController::class, 'halamanBayar'])->name('checkout.bayar');
    Route::post('/checkout/upload-bukti/{id}', [CheckoutController::class, 'uploadBukti'])->name('checkout.upload');

});
