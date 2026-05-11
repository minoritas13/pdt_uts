<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PenerbitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('buku', BukuController::class);
Route::resource('penerbit', PenerbitController::class);
