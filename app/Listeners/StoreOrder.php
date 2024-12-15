<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\OrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class StoreOrder
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function handle(OrderCreated $event): void
    {
        $this->orderService->storeOrder($event->orderData);
    }
}
