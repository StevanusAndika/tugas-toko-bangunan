<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class PenjualanTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_user_can_view_penjualan_index_page()
    {
        Http::fake([
            'localhost:8000/api/penjualan/list-data' => Http::response([
                'success' => true,
                'data' => []
            ], 200)
        ]);

        $response = $this->get('/penjualan');
        $response->assertStatus(200);
    }

    public function test_user_can_view_create_penjualan_page()
    {
        Http::fake([
            'localhost:8000/api/karyawan/list-data' => Http::response([
                'success' => true,
                'data' => [
                    [
                        'id' => 1,
                        'Nama' => 'Test Karyawan',
                        'Gender' => 'L',
                        'Sandi' => 'test123'
                    ]
                ]
            ], 200)
        ]);

        $response = $this->get('/penjualan/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_new_penjualan()
    {
        // Mock untuk mendapatkan data karyawan
        Http::fake([
            'localhost:8000/api/karyawan/list-data' => Http::response([
                'success' => true,
                'data' => [
                    [
                        'id' => 1,
                        'Nama' => 'Test Karyawan',
                        'Gender' => 'L',
                        'Sandi' => 'test123'
                    ]
                ]
            ], 200),
            'localhost:8000/api/penjualan/simpan' => Http::response([
                'success' => true,
                'message' => 'Data penjualan berhasil disimpan'
            ], 201)
        ]);

        $response = $this->post('/penjualan', [
            'tgl' => '2024-01-15 15:00:00',
            'pengguna_id' => 1
        ]);

        $response->assertRedirect(route('penjualan.index'));
    }

    public function test_penjualan_creation_requires_valid_data()
    {
        $response = $this->post('/penjualan', [
            'tgl' => '',
            'pengguna_id' => ''
        ]);

        $response->assertSessionHasErrors(['tgl', 'pengguna_id']);
    }
}
