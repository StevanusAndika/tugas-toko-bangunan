<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Karyawan Routes
Route::get('/karyawan/list-data', [KaryawanController::class, 'lihatData']);
Route::post('/karyawan/simpan', [KaryawanController::class, 'simpanData']);
Route::delete('/karyawan/hapus/{id}', [KaryawanController::class, 'hapusData']);

// Produk Routes
Route::get('/produk/list-data', [ProdukController::class, 'lihatData']);
Route::post('/produk/simpan', [ProdukController::class, 'simpanData']);
Route::delete('/produk/hapus/{id}', [ProdukController::class, 'hapusData']);

// Penjualan Routes
Route::get('/penjualan/list-data', [PenjualanController::class, 'lihatData']);
Route::post('/penjualan/simpan', [PenjualanController::class, 'simpanData']);
Route::delete('/penjualan/hapus/{id}', [PenjualanController::class, 'hapusData']);
Route::get('/penjualan/list-detail/{penjualan_id}', [PenjualanController::class, 'lihatDetail']);
Route::post('/penjualan/simpan-detail', [PenjualanController::class, 'simpanDetail']);
Route::delete('/penjualan/hapus-detail/{id}', [PenjualanController::class, 'hapusDetail']);
