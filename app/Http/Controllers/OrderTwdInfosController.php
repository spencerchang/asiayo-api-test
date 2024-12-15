<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderTwdInfoCreateRequest;
use App\Http\Requests\OrderTwdInfoUpdateRequest;
use App\Repositories\OrderTwdInfoRepository;
use App\Validators\OrderTwdInfoValidator;

/**
 * Class OrderTwdInfosController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrderTwdInfosController extends Controller
{
    /**
     * @var OrderTwdInfoRepository
     */
    protected $repository;

    /**
     * @var OrderTwdInfoValidator
     */
    protected $validator;

    /**
     * OrderTwdInfosController constructor.
     *
     * @param OrderTwdInfoRepository $repository
     * @param OrderTwdInfoValidator $validator
     */
    public function __construct(OrderTwdInfoRepository $repository, OrderTwdInfoValidator $validator)
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
        $orderTwdInfos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderTwdInfos,
            ]);
        }

        return view('orderTwdInfos.index', compact('orderTwdInfos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderTwdInfoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderTwdInfoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $orderTwdInfo = $this->repository->create($request->all());

            $response = [
                'message' => 'OrderTwdInfo created.',
                'data'    => $orderTwdInfo->toArray(),
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
        $orderTwdInfo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderTwdInfo,
            ]);
        }

        return view('orderTwdInfos.show', compact('orderTwdInfo'));
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
        $orderTwdInfo = $this->repository->find($id);

        return view('orderTwdInfos.edit', compact('orderTwdInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderTwdInfoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderTwdInfoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $orderTwdInfo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrderTwdInfo updated.',
                'data'    => $orderTwdInfo->toArray(),
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
                'message' => 'OrderTwdInfo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrderTwdInfo deleted.');
    }
}
