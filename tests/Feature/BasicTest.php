<?php

namespace Tests\Feature;

use Tests\TestCase;

class BasicTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\Test]
    public function home_page_works()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function karyawan_route_exists()
    {
        $response = $this->get('/karyawan');
        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function produk_route_exists()
    {
        $response = $this->get('/produk');
        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function penjualan_route_exists()
    {
        $response = $this->get('/penjualan');
        $response->assertStatus(200);
    }
}
