<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class KaryawanTest extends TestCase
{
    // HAPUS: use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
    }

    public function test_user_can_view_karyawan_index_page()
    {
        Http::fake([
            'localhost:8000/api/karyawan/list-data' => Http::response([
                'success' => true,
                'data' => [
                    [
                        'id' => 1,
                        'Nama' => 'John Doe',
                        'Gender' => 'L',
                        'Sandi' => 'password123'
                    ]
                ]
            ], 200)
        ]);

        $response = $this->get('/karyawan');
        $response->assertStatus(200);
        $response->assertSee('John Doe');
    }

    public function test_user_can_view_create_karyawan_page()
    {
        $response = $this->get('/karyawan/create');
        $response->assertStatus(200);
    }

    public function test_user_can_create_new_karyawan()
    {
        Http::fake([
            'localhost:8000/api/karyawan/simpan' => Http::response([
                'success' => true,
                'message' => 'Data karyawan berhasil disimpan'
            ], 201)
        ]);

        $response = $this->post('/karyawan', [
            'Nama' => 'Jane Smith',
            'Gender' => 'P',
            'Sandi' => 'securepass'
        ]);

        $response->assertRedirect(route('karyawan.index'));
    }

    public function test_karyawan_creation_requires_valid_data()
    {
        $response = $this->post('/karyawan', [
            'Nama' => '',
            'Gender' => '',
            'Sandi' => ''
        ]);

        $response->assertSessionHasErrors(['Nama', 'Gender', 'Sandi']);
    }
}
