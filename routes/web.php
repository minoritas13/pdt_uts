<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('buku', BukuController::class);
Route::resource('penerbit', PenerbitController::class);

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');

Route::post('/cart/add/{id}', [KatalogController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [KatalogController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update', [KatalogController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [KatalogController::class, 'removeFromCart'])->name('cart.remove');

Route::post('/checkout', [CheckoutController::class, 'prosesCheckout'])->name('checkout.proses');
Route::get('/checkout/bayar/{id}', [CheckoutController::class, 'halamanBayar'])->name('checkout.bayar');
Route::post('/checkout/upload-bukti/{id}', [CheckoutController::class, 'uploadBukti'])->name('checkout.upload');

Route::get('/kasir/online', [KasirController::class, 'pesananOnline'])->name('kasir.online');
Route::post('/kasir/online/acc/{id}', [KasirController::class, 'accPesananOnline'])->name('kasir.acc');
Route::get('/kasir/pos', [KasirController::class, 'mesinPOS'])->name('kasir.pos');
Route::post('/kasir/pos/proses', [KasirController::class, 'prosesPOS'])->name('kasir.pos.proses');

