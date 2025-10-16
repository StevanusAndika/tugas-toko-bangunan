<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ProdukTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_user_can_view_produk_index_page()
    {
        Http::fake([
            'localhost:8000/api/produk/list-data' => Http::response([
                'success' => true,
                'data' => [
                    [
                        'id' => 1,
                        'Produk' => 'Laptop Gaming',
                        'Harga' => 15000000,
                        'Stok' => 10,
                        'created_at' => '2024-01-15T10:00:00.000000Z' // TAMBAHKAN created_at
                    ]
                ]
            ], 200)
        ]);

        $response = $this->get('/produk');
        $response->assertStatus(200);
        $response->assertSee('Laptop Gaming');
    }

    public function test_user_can_view_create_produk_page()
    {
        $response = $this->get('/produk/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_new_produk()
    {
        Http::fake([
            'localhost:8000/api/produk/simpan' => Http::response([
                'success' => true,
                'message' => 'Data produk berhasil disimpan'
            ], 201)
        ]);

        $response = $this->post('/produk', [
            'Produk' => 'Mouse Wireless',
            'Harga' => 250000,
            'Stok' => 50
        ]);

        $response->assertRedirect(route('produk.index'));
    }

    public function test_produk_creation_requires_valid_data()
    {
        $response = $this->post('/produk', [
            'Produk' => '',
            'Harga' => 'invalid',
            'Stok' => -5
        ]);

        $response->assertSessionHasErrors(['Produk', 'Harga', 'Stok']);
    }
}
