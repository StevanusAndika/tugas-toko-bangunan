<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class DetailPenjualanTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_user_can_view_create_detail_penjualan_page()
    {
        Http::fake([
            'localhost:8000/api/produk/list-data' => Http::response([
                'success' => true,
                'data' => [
                    [
                        'id' => 1,
                        'Produk' => 'Laptop Gaming',
                        'Harga' => 15000000,
                        'Stok' => 10
                    ]
                ]
            ], 200)
        ]);

        $response = $this->get('/penjualan/1/detail/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_new_detail_penjualan()
    {
        // Mock untuk mendapatkan data produk dan simpan detail
        Http::fake([
            'localhost:8000/api/produk/list-data' => Http::response([
                'success' => true,
                'data' => [
                    [
                        'id' => 1,
                        'Produk' => 'Laptop Gaming',
                        'Harga' => 15000000,
                        'Stok' => 10
                    ]
                ]
            ], 200),
            'localhost:8000/api/penjualan/simpan-detail' => Http::response([
                'success' => true,
                'message' => 'Detail penjualan berhasil disimpan'
            ], 201)
        ]);

        $response = $this->post('/penjualan/detail', [
            'penjualan_id' => 1,
            'produk_id' => 1,
            'qty' => 2,
            'harga' => 15000000
        ]);

        $response->assertRedirect(route('penjualan.detail', 1));
    }

    public function test_detail_penjualan_creation_requires_valid_data()
    {
        $response = $this->post('/penjualan/detail', [
            'penjualan_id' => '',
            'produk_id' => '',
            'qty' => '',
            'harga' => ''
        ]);

        $response->assertSessionHasErrors(['penjualan_id', 'produk_id', 'qty', 'harga']);
    }
}
