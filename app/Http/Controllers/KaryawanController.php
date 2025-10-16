<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KaryawanController extends Controller
{
    public function lihatData()
    {
        $karyawan = Karyawan::all();
        return response()->json([
            'success' => true,
            'data' => $karyawan
        ]);
    }

    public function simpanData(Request $request)
    {
        $validated = $request->validate([
            'Nama' => 'required|string|max:30',
            'Gender' => 'required|in:L,P',
            'Sandi' => 'required|string'
        ]);

        $karyawan = Karyawan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data karyawan berhasil disimpan',
            'data' => $karyawan
        ], Response::HTTP_CREATED);
    }

    public function hapusData($id)
    {
        $karyawan = Karyawan::find($id);

        if (!$karyawan) {
            return response()->json([
                'success' => false,
                'message' => 'Data karyawan tidak ditemukan'
            ], Response::HTTP_NOT_FOUND);
        }

        $karyawan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data karyawan berhasil dihapus'
        ]);
    }
}
