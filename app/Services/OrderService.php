<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Repositories\OrderInfoRepository;
use App\Repositories\OrderTwdInfoRepository;
use App\Repositories\OrderUsdInfoRepository;
use App\Repositories\OrderJpyInfoRepository;
use App\Repositories\OrderRmbInfoRepository;
use App\Repositories\OrderMyrInfoRepository;
use App\Models\OrderInfo;

class OrderService
{
    protected $orderInfosRepository;
    protected $orderTwdInfosRepository;
    protected $orderJpyInfosRepository;

    public function __construct(
        OrderInfoRepository $orderInfosRepository,
        OrderTwdInfoRepository $orderTwdInfosRepository,
        OrderUsdInfoRepository $orderUsdInfosRepository,
        OrderJpyInfoRepository $orderJpyInfosRepository,
        OrderRmbInfoRepository $orderRmbInfosRepository,
        OrderMyrInfoRepository $orderMyrInfosRepository,
      
    ) {
        $this->orderInfosRepository = $orderInfosRepository;
        // dynamic currency repository
        $this->currencyRepositories = [
            'TWD' => $orderTwdInfosRepository,
            'USD' => $orderUsdInfosRepository,
            'JPY' => $orderJpyInfosRepository,
            'RMB' => $orderRmbInfosRepository,
            'MYR' => $orderMyrInfosRepository,
        ];
    }


    public function storeOrder(array $orderData): void
    {
        $address = json_encode([
            "city" => $orderData['address']['city'],
            "district" => $orderData['address']['district'],
            "street" => $orderData['address']['street'],
        ]);
        $currency = strtoupper($orderData['currency']);

        DB::beginTransaction();
        try {
            $addData = [
                'show_order_id' => $orderData['id'],
                'name' => $orderData['name'],
                'address' => $address,
                'price' => $orderData['price'],
                'currency' => $currency,
            ];
            // add to order table
            $this->orderInfosRepository->create($addData);
            // save to currency order table
            if (isset($this->currencyRepositories[$currency])) {
                $this->currencyRepositories[$currency]->create($addData);
            } else {
                throw new Exception('Unsupported currency: ' . $currency);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to store order: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getOrderById(string $showOrderId)
    {
        return $this->orderInfosRepository->getByShowOrderId($showOrderId);
    }
}