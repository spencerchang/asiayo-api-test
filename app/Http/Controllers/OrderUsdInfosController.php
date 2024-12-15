<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderUsdInfoCreateRequest;
use App\Http\Requests\OrderUsdInfoUpdateRequest;
use App\Repositories\OrderUsdInfoRepository;
use App\Validators\OrderUsdInfoValidator;

/**
 * Class OrderUsdInfosController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrderUsdInfosController extends Controller
{
    /**
     * @var OrderUsdInfoRepository
     */
    protected $repository;

    /**
     * @var OrderUsdInfoValidator
     */
    protected $validator;

    /**
     * OrderUsdInfosController constructor.
     *
     * @param OrderUsdInfoRepository $repository
     * @param OrderUsdInfoValidator $validator
     */
    public function __construct(OrderUsdInfoRepository $repository, OrderUsdInfoValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $orderUsdInfos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderUsdInfos,
            ]);
        }

        return view('orderUsdInfos.index', compact('orderUsdInfos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderUsdInfoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderUsdInfoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $orderUsdInfo = $this->repository->create($request->all());

            $response = [
                'message' => 'OrderUsdInfo created.',
                'data'    => $orderUsdInfo->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $orderUsdInfo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderUsdInfo,
            ]);
        }

        return view('orderUsdInfos.show', compact('orderUsdInfo'));
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
        $orderUsdInfo = $this->repository->find($id);

        return view('orderUsdInfos.edit', compact('orderUsdInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUsdInfoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderUsdInfoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $orderUsdInfo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrderUsdInfo updated.',
                'data'    => $orderUsdInfo->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'OrderUsdInfo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrderUsdInfo deleted.');
    }
}
