<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProdukController extends Controller
{
    public function lihatData()
    {
        try {
            $produk = Produk::all();

            return response()->json([
                'success' => true,
                'data' => $produk
            ]);

        } catch (\Exception $e) {
            Log::error('Error in lihatData: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => env('APP_DEBUG') ? $e->getMessage() : 'Internal Server Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function simpanData(Request $request)
    {
        try {
            $validated = $request->validate([
                'Produk' => 'required|string|max:30',
                'Harga' => 'required|numeric|min:0',
                'Stok' => 'required|integer|min:0'
            ]);

            $produk = Produk::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data produk berhasil disimpan',
                'data' => $produk
            ], Response::HTTP_CREATED);

        } catch (\Exception $e) {
            Log::error('Error in simpanData: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data produk',
                'error' => env('APP_DEBUG') ? $e->getMessage() : 'Internal Server Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function hapusData($id)
    {
        try {
            $produk = Produk::find($id);

            if (!$produk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data produk tidak ditemukan'
                ], Response::HTTP_NOT_FOUND);
            }

            $produk->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data produk berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            Log::error('Error in hapusData: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data produk',
                'error' => env('APP_DEBUG') ? $e->getMessage() : 'Internal Server Error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
