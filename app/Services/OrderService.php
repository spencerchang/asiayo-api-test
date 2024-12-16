<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\OrderInfoRepository;
use App\Repositories\OrderTwdInfoRepository;
use App\Repositories\OrderUsdInfoRepository;
use App\Repositories\OrderJpyInfoRepository;
use App\Repositories\OrderRmbInfoRepository;
use App\Repositories\OrderMyrInfoRepository;
use App\Validators\OrderInfoValidator;
use App\Models\OrderInfo;

class OrderService
{
    protected $orderInfosRepository;
    protected $currencyRepositories;
    protected $orderTwdInfosRepository;
    protected $orderJpyInfosRepository;
    protected $orderRmbInfosRepository;
    protected $orderMyrInfosRepository;
    protected $orderInfoValidator;

    public function __construct(
        OrderInfoRepository $orderInfosRepository,
        OrderTwdInfoRepository $orderTwdInfosRepository,
        OrderUsdInfoRepository $orderUsdInfosRepository,
        OrderJpyInfoRepository $orderJpyInfosRepository,
        OrderRmbInfoRepository $orderRmbInfosRepository,
        OrderMyrInfoRepository $orderMyrInfosRepository,
        OrderInfoValidator $orderInfoValidator,
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
        $this->orderInfoValidator = $orderInfoValidator;
    }


    public function storeOrder(array $orderData)
    {
        $address = json_encode([
            "city" => $orderData['address']['city'],
            "district" => $orderData['address']['district'],
            "street" => $orderData['address']['street'],
        ]);
        $currency = strtoupper($orderData['currency']);

        $addData = [
            'show_order_id' => $orderData['id'],
            'name' => $orderData['name'],
            'address' => $address,
            'price' => $orderData['price'],
            'currency' => $currency,
        ];
        // valid custom address valid
        try {
            if ($addData['address']) {
                $this->orderInfoValidator->validateAddressDetail('address', $addData['address'], [], $this->orderInfoValidator);
            }
        } catch (ValidatorException $e) {
            return response()->json([
                'error' => 'valid failed',
                'details' => $e->getMessage()
            ], 422);
        }

        DB::beginTransaction();
        try {
            // add to order table
            $this->orderInfosRepository->create($addData);
            // save to currency order table
            if (isset($this->currencyRepositories[$currency])) {
                $this->currencyRepositories[$currency]->create($addData);
            } else {
                throw new Exception('Unsupported currency: ' . $currency);
            }
            DB::commit();
            return response()->json(['message' => 'Order stored successfully']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to store order: ' . $e->getMessage());

            return response()->json([
                'error' => 'Order storage failed',
                'details' => $e->getMessage()
            ], 422);
        }
    }

    public function getOrderById(string $showOrderId)
    {
        return $this->orderInfosRepository->getByShowOrderId($showOrderId);
    }
}
