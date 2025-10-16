<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\WebViewController;

Route::get('/', function () {
    return view('welcome');
});

// Karyawan Routes
Route::get('/karyawan', [WebViewController::class, 'showKaryawan'])->name('karyawan.index');
Route::get('/karyawan/create', [WebViewController::class, 'createKaryawan'])->name('karyawan.create');
Route::post('/karyawan', [WebViewController::class, 'storeKaryawan'])->name('karyawan.store');
Route::delete('/karyawan/{id}', [WebViewController::class, 'destroyKaryawan'])->name('karyawan.destroy');

// Produk Routes
Route::get('/produk', [WebViewController::class, 'showProduk'])->name('produk.index');
Route::get('/produk/create', [WebViewController::class, 'createProduk'])->name('produk.create');
Route::post('/produk', [WebViewController::class, 'storeProduk'])->name('produk.store');
Route::delete('/produk/{id}', [WebViewController::class, 'destroyProduk'])->name('produk.destroy');

// Penjualan Routes
Route::get('/penjualan', [WebViewController::class, 'showPenjualan'])->name('penjualan.index');
Route::get('/penjualan/create', [WebViewController::class, 'createPenjualan'])->name('penjualan.create');
Route::post('/penjualan', [WebViewController::class, 'storePenjualan'])->name('penjualan.store');
Route::delete('/penjualan/{id}', [WebViewController::class, 'destroyPenjualan'])->name('penjualan.destroy');

// Detail Penjualan Routes
Route::get('/penjualan/{id}/detail', [WebViewController::class, 'showDetailPenjualan'])->name('penjualan.detail');
Route::get('/penjualan/{id}/detail/create', [WebViewController::class, 'createDetailPenjualan'])->name('penjualan.detail.create');
Route::post('/penjualan/detail', [WebViewController::class, 'storeDetailPenjualan'])->name('penjualan.detail.store');
Route::delete('/penjualan/detail/{id}', [WebViewController::class, 'destroyDetailPenjualan'])->name('penjualan.detail.destroy');
