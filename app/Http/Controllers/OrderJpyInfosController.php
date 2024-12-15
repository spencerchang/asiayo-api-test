<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderJpyInfoCreateRequest;
use App\Http\Requests\OrderJpyInfoUpdateRequest;
use App\Repositories\OrderJpyInfoRepository;
use App\Validators\OrderJpyInfoValidator;

/**
 * Class OrderJpyInfosController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrderJpyInfosController extends Controller
{
    /**
     * @var OrderJpyInfoRepository
     */
    protected $repository;

    /**
     * @var OrderJpyInfoValidator
     */
    protected $validator;

    /**
     * OrderJpyInfosController constructor.
     *
     * @param OrderJpyInfoRepository $repository
     * @param OrderJpyInfoValidator $validator
     */
    public function __construct(OrderJpyInfoRepository $repository, OrderJpyInfoValidator $validator)
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
        $orderJpyInfos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderJpyInfos,
            ]);
        }

        return view('orderJpyInfos.index', compact('orderJpyInfos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderJpyInfoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderJpyInfoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $orderJpyInfo = $this->repository->create($request->all());

            $response = [
                'message' => 'OrderJpyInfo created.',
                'data'    => $orderJpyInfo->toArray(),
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
        $orderJpyInfo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderJpyInfo,
            ]);
        }

        return view('orderJpyInfos.show', compact('orderJpyInfo'));
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
        $orderJpyInfo = $this->repository->find($id);

        return view('orderJpyInfos.edit', compact('orderJpyInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderJpyInfoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderJpyInfoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $orderJpyInfo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrderJpyInfo updated.',
                'data'    => $orderJpyInfo->toArray(),
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
                'message' => 'OrderJpyInfo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrderJpyInfo deleted.');
    }
}
