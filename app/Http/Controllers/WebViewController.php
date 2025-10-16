<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebViewController extends Controller
{
    private $apiBaseUrl;

    public function __construct()
    {
        $this->apiBaseUrl = 'http://localhost:8000/api';
    }

    // ==================== KARYAWAN ====================
    public function showKaryawan()
    {
        try {
            $response = Http::get("{$this->apiBaseUrl}/karyawan/list-data");

            if ($response->successful()) {
                $data = $response->json();
                $karyawan = $data['data'] ?? [];
                return view('karyawan.index', compact('karyawan'));
            } else {
                return back()->with('error', 'Gagal mengambil data karyawan');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching karyawan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil data');
        }
    }

    public function createKaryawan()
    {
        return view('karyawan.create');
    }

    public function storeKaryawan(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:30',
            'Gender' => 'required|in:L,P',
            'Sandi' => 'required|string'
        ]);

        try {
            $response = Http::post("{$this->apiBaseUrl}/karyawan/simpan", [
                'Nama' => $request->Nama,
                'Gender' => $request->Gender,
                'Sandi' => $request->Sandi
            ]);

            if ($response->successful()) {
                return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil disimpan');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menyimpan data');
            }
        } catch (\Exception $e) {
            Log::error('Error storing karyawan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destroyKaryawan($id)
    {
        try {
            $response = Http::delete("{$this->apiBaseUrl}/karyawan/hapus/{$id}");

            if ($response->successful()) {
                return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menghapus data');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting karyawan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    // ==================== PRODUK ====================
    public function showProduk()
    {
        try {
            $response = Http::get("{$this->apiBaseUrl}/produk/list-data");

            if ($response->successful()) {
                $data = $response->json();
                $produk = $data['data'] ?? [];
                return view('produk.index', compact('produk'));
            } else {
                return back()->with('error', 'Gagal mengambil data produk');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching produk: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil data');
        }
    }

    public function createProduk()
    {
        return view('produk.create');
    }

    public function storeProduk(Request $request)
    {
        $request->validate([
            'Produk' => 'required|string|max:30',
            'Harga' => 'required|numeric|min:0',
            'Stok' => 'required|integer|min:0'
        ]);

        try {
            $response = Http::post("{$this->apiBaseUrl}/produk/simpan", [
                'Produk' => $request->Produk,
                'Harga' => $request->Harga,
                'Stok' => $request->Stok
            ]);

            if ($response->successful()) {
                return redirect()->route('produk.index')->with('success', 'Data produk berhasil disimpan');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menyimpan data');
            }
        } catch (\Exception $e) {
            Log::error('Error storing produk: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destroyProduk($id)
    {
        try {
            $response = Http::delete("{$this->apiBaseUrl}/produk/hapus/{$id}");

            if ($response->successful()) {
                return redirect()->route('produk.index')->with('success', 'Data produk berhasil dihapus');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menghapus data');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting produk: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    // ==================== PENJUALAN ====================
    public function showPenjualan()
    {
        try {
            $response = Http::get("{$this->apiBaseUrl}/penjualan/list-data");

            if ($response->successful()) {
                $data = $response->json();
                $penjualan = $data['data'] ?? [];
                return view('penjualan.index', compact('penjualan'));
            } else {
                return back()->with('error', 'Gagal mengambil data penjualan');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching penjualan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil data');
        }
    }

    public function createPenjualan()
    {
        try {
            // Get karyawan for dropdown
            $response = Http::get("{$this->apiBaseUrl}/karyawan/list-data");
            $karyawan = $response->successful() ? $response->json()['data'] ?? [] : [];

            return view('penjualan.create', compact('karyawan'));
        } catch (\Exception $e) {
            Log::error('Error creating penjualan form: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form');
        }
    }

    public function storePenjualan(Request $request)
    {
        $request->validate([
            'tgl' => 'required|date',
            'pengguna_id' => 'required|exists:karyawan,id'
        ]);

        try {
            $response = Http::post("{$this->apiBaseUrl}/penjualan/simpan", [
                'tgl' => $request->tgl,
                'pengguna_id' => $request->pengguna_id
            ]);

            if ($response->successful()) {
                return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil disimpan');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menyimpan data');
            }
        } catch (\Exception $e) {
            Log::error('Error storing penjualan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data');
        }
    }

    public function destroyPenjualan($id)
    {
        try {
            $response = Http::delete("{$this->apiBaseUrl}/penjualan/hapus/{$id}");

            if ($response->successful()) {
                return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menghapus data');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting penjualan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }

    // ==================== DETAIL PENJUALAN ====================
    public function showDetailPenjualan($id)
    {
        try {
            $response = Http::get("{$this->apiBaseUrl}/penjualan/list-detail/{$id}");

            if ($response->successful()) {
                $data = $response->json();
                $details = $data['data'] ?? [];
                $penjualan_id = $id;
                return view('penjualan.detail', compact('details', 'penjualan_id'));
            } else {
                return back()->with('error', 'Gagal mengambil data detail penjualan');
            }
        } catch (\Exception $e) {
            Log::error('Error fetching detail penjualan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mengambil data');
        }
    }

    public function createDetailPenjualan($id)
    {
        try {
            // Get produk for dropdown
            $response = Http::get("{$this->apiBaseUrl}/produk/list-data");
            $produk = $response->successful() ? $response->json()['data'] ?? [] : [];

            $penjualan_id = $id;
            return view('penjualan.detail-create', compact('produk', 'penjualan_id'));
        } catch (\Exception $e) {
            Log::error('Error creating detail penjualan form: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat memuat form');
        }
    }

    public function storeDetailPenjualan(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'produk_id' => 'required|exists:produk,id',
            'qty' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0'
        ]);

        try {
            $response = Http::post("{$this->apiBaseUrl}/penjualan/simpan-detail", [
                'penjualan_id' => $request->penjualan_id,
                'produk_id' => $request->produk_id,
                'qty' => $request->qty,
                'harga' => $request->harga
            ]);

            if ($response->successful()) {
                return redirect()->route('penjualan.detail', $request->penjualan_id)
                    ->with('success', 'Detail penjualan berhasil disimpan');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menyimpan detail penjualan');
            }
        } catch (\Exception $e) {
            Log::error('Error storing detail penjualan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan detail penjualan');
        }
    }

    public function destroyDetailPenjualan($id)
    {
        try {
            $response = Http::delete("{$this->apiBaseUrl}/penjualan/hapus-detail/{$id}");

            if ($response->successful()) {
                return back()->with('success', 'Detail penjualan berhasil dihapus');
            } else {
                $error = $response->json();
                return back()->with('error', $error['message'] ?? 'Gagal menghapus detail penjualan');
            }
        } catch (\Exception $e) {
            Log::error('Error deleting detail penjualan: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghapus detail penjualan');
        }
    }
}
