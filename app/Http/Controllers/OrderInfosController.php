<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\OrderInfoCreateRequest;
use App\Http\Requests\OrderInfoUpdateRequest;
use App\Services\OrderService;
use App\Events\OrderCreated;


/**
 * Class OrderInfosController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrderInfosController extends Controller
{
    private OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        // $orderInfos = $this->repository->all();

        // if (request()->wantsJson()) {

        //     return response()->json([
        //         'data' => $orderInfos,
        //     ]);
        // }

        // return view('orderInfos.index', compact('orderInfos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderInfoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderInfoCreateRequest $req)
    {
        $validOrderData = $req->validated();
        event(new OrderCreated($validOrderData));
        return response()->json(['message' => 'Order created successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get order id
        $orderInfo = $this->orderService->getOrderById($id);

        if (!$orderInfo) {
            return response()->json([
                'message' => 'Order not found'
            ], 404);
        }
        return response()->json($orderInfo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $orderInfo = $this->repository->find($id);

        // return view('orderInfos.edit', compact('orderInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderInfoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderInfoUpdateRequest $request, $id)
    {
        // try {

        //     $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

        //     $orderInfo = $this->repository->update($request->all(), $id);

        //     $response = [
        //         'message' => 'OrderInfo updated.',
        //         'data'    => $orderInfo->toArray(),
        //     ];

        //     if ($request->wantsJson()) {

        //         return response()->json($response);
        //     }

        //     return redirect()->back()->with('message', $response['message']);
        // } catch (ValidatorException $e) {

        //     if ($request->wantsJson()) {

        //         return response()->json([
        //             'error'   => true,
        //             'message' => $e->getMessageBag()
        //         ]);
        //     }

        //     return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        // }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $deleted = $this->repository->delete($id);

        // if (request()->wantsJson()) {

        //     return response()->json([
        //         'message' => 'OrderInfo deleted.',
        //         'deleted' => $deleted,
        //     ]);
        // }

        // return redirect()->back()->with('message', 'OrderInfo deleted.');
    }
}
