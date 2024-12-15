<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Services\OrderService;

class OrderStoreTest extends TestCase
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

        $res = $this->json('POST', '/api/orders', $orderData);
        $res->assertStatus(200);
        $res->assertJson(['message' => 'Order created successfully']);

        // check is availble in table
        $this->assertDatabaseHas('order_infos', [
            'show_order_id' => $orderData['id'],
            'currency' => $orderData['currency'],
        ]);
        // check order availble in order currency table
        $this->assertDatabaseHas($targetOrderTable, [
            'show_order_id' => $orderData['id'],
        ]);
    }

    public function testCreateInvalidOrder()
    {
        // invalid cases
        $invalidCases = [
            [
                'data' => [
                    'id' => '', // id error
                    'name' => 'Test Name',
                    'address' => ['city' => 'Test City', 'district' => 'Test District', 'street' => 'Test Street'],
                    'price' => '2050',
                    'currency' => 'TWD',
                ],
                'expectedErrors' => ['id'],
            ],
            [
                'data' => [
                    'id' => 'A0000002',
                    'name' => '', // name error
                    'address' => ['city' => 'Test City', 'district' => 'Test District', 'street' => 'Test Street'],
                    'price' => '2050',
                    'currency' => 'TWD',
                ],
                'expectedErrors' => ['name'],
            ],
            [
                'data' => [
                    'id' => 'A0000003',
                    'name' => 'Test Name',
                    'address' => ['city' => 'Test City', 'district' => 'Test District', 'street' => ''], // street error
                    'price' => '2050',
                    'currency' => 'TWD',
                ],
                'expectedErrors' => ['address.street'],
            ],
            [
                'data' => [
                    'id' => 'A0000004',
                    'name' => 'Test Name',
                    'address' => ['city' => 'Test City', 'district' => 'Test District', 'street' => 'Test Street'],
                    'price' => '-1', // price error
                    'currency' => 'TWD',
                ],
                'expectedErrors' => ['price'],
            ],
            [
                'data' => [
                    'id' => 'A0000005',
                    'name' => 'Test Name',
                    'address' => ['city' => 'Test City', 'district' => 'Test District', 'street' => 'Test Street'],
                    'price' => '2050',
                    'currency' => 'XYZ', // currency error
                ],
                'expectedErrors' => ['currency'],
            ],
        ];

        // run diff cases
        foreach ($invalidCases as $case) {
            $res = $this->json('POST', '/api/orders', $case['data']);
            $res->assertStatus(422);
            $res->assertJsonValidationErrors($case['expectedErrors']);

            $this->assertDatabaseMissing('order_infos', ['show_order_id' => $case['data']['id']]);
        }
    }
}
