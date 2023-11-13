<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    
    public function test_product_index(): void
    {
        $response = $this->get('/api/v1/product');
        $response->assertOk();

    }
    public function test_order_index(): void
    {
        $response = $this->postJson('/api/v1/order', ['page' => 1, 'paginate' => 5]);
        $response->assertOk();

    }
    public function test_warehouse_index(): void
    {
        $response = $this->get('/api/v1/warehouses');
        $response->assertOk();

    }
    public function test_movements_index(): void
    {
        $response = $this->postJson('/api/v1/movements', ['page' => 1, 'paginate' => 5]);
        $response->assertOk();

    }
}
