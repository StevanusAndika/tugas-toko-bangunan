<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function lihatData()
    {
        $penjualan = Penjualan::with('karyawan')->get();
        return response()->json([
            'success' => true,
            'data' => $penjualan
        ]);
    }

    public function simpanData(Request $request)
    {
        $validated = $request->validate([
            'tgl' => 'required|date',
            'pengguna_id' => 'required|exists:karyawan,id'
        ]);

        $penjualan = Penjualan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data penjualan berhasil disimpan',
            'data' => $penjualan
        ], Response::HTTP_CREATED);
    }

    public function hapusData($id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return response()->json([
                'success' => false,
                'message' => 'Data penjualan tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $penjualan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data penjualan berhasil dihapus'
        ]);
    }

    public function lihatDetail($penjualan_id)
    {
        $detail = DetailPenjualan::with(['produk', 'penjualan'])
            ->where('penjualan_id', $penjualan_id)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $detail
        ]);
    }

    public function simpanDetail(Request $request)
    {
        $validated = $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'produk_id' => 'required|exists:produk,id',
            'qty' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        // Check stok produk
        $produk = \App\Models\Produk::find($validated['produk_id']);
        if ($produk->Stok < $validated['qty']) {
            return response()->json([
                'success' => false,
                'message' => 'Stok produk tidak mencukupi'
            ], Response::HTTP_BAD_REQUEST);
        }

        DB::transaction(function () use ($validated, $produk) {
            // Simpan detail penjualan
            $detail = DetailPenjualan::create($validated);

            // Update stok produk
            $produk->decrement('Stok', $validated['qty']);
        });

        return response()->json([
            'success' => true,
            'message' => 'Detail penjualan berhasil disimpan'
        ], Response::HTTP_CREATED);
    }

    public function hapusDetail($id)
    {
        $detail = DetailPenjualan::find($id);

        if (!$detail) {
            return response()->json([
                'success' => false,
                'message' => 'Detail penjualan tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        DB::transaction(function () use ($detail) {
            // Kembalikan stok produk
            $produk = \App\Models\Produk::find($detail->produk_id);
            $produk->increment('Stok', $detail->qty);

            // Hapus detail penjualan
            $detail->delete();
        });

        return response()->json([
            'success' => true,
            'message' => 'Detail penjualan berhasil dihapus'
        ]);
    }
}
