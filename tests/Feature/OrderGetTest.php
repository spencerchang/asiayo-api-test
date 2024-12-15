<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\OrderService;

class OrderGetTest extends TestCase
{
    use RefreshDatabase;

    protected $orderService;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderService = app(OrderService::class);
    }

    public function testGetValidOrder()
    {
        $orderData = [
            'id' => 'A0000001',
            'name' => 'Test Name',
            'address' => [
                'city' => 'Taipei',
                'district' => 'Xinyi',
                'street' => 'Xinyi Road',
            ],
            'price' => 1000,
            'currency' => 'TWD',
        ];
        $this->orderService->storeOrder($orderData);
        $res = $this->json('GET', '/api/orders/'.$orderData['id'], $orderData);
        $res->assertStatus(200);
    }

    public function testGetInvalidOrder()
    {
        $res = $this->getJson('/api/orders/A9999999');

        $res->assertStatus(404);
        $res->assertJson(['message' => 'Order not found']);
    }
    
}
