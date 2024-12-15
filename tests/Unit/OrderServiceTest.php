<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\OrderService;

class OrderServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $orderService;

    public function setUp(): void
    {
        parent::setUp();
        $this->orderService = app(OrderService::class);
    }

    public function testCreateValidOrder()
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
        $targetOrderTable = 'order_' . strtolower($orderData['currency']).'_infos';

        $this->orderService->storeOrder($orderData);

        // check is availble in order table
        $this->assertDatabaseHas('order_infos', [
            'show_order_id' => $orderData['id'],
            'currency' => $orderData['currency'],
        ]);
        // check order availble in order currency table
        $this->assertDatabaseHas($targetOrderTable, [
            'show_order_id' => $orderData['id'],
        ]);
    }
}
