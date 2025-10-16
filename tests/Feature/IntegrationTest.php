<?php

namespace Tests\Feature;

use Tests\TestCase;

class IntegrationTest extends TestCase
{
    /** @test */
    public function basic_integration_test()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
