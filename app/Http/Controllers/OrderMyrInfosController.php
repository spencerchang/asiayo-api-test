<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderMyrInfoCreateRequest;
use App\Http\Requests\OrderMyrInfoUpdateRequest;
use App\Repositories\OrderMyrInfoRepository;
use App\Validators\OrderMyrInfoValidator;

/**
 * Class OrderMyrInfosController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrderMyrInfosController extends Controller
{
    /**
     * @var OrderMyrInfoRepository
     */
    protected $repository;

    /**
     * @var OrderMyrInfoValidator
     */
    protected $validator;

    /**
     * OrderMyrInfosController constructor.
     *
     * @param OrderMyrInfoRepository $repository
     * @param OrderMyrInfoValidator $validator
     */
    public function __construct(OrderMyrInfoRepository $repository, OrderMyrInfoValidator $validator)
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
        $orderMyrInfos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderMyrInfos,
            ]);
        }

        return view('orderMyrInfos.index', compact('orderMyrInfos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderMyrInfoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderMyrInfoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $orderMyrInfo = $this->repository->create($request->all());

            $response = [
                'message' => 'OrderMyrInfo created.',
                'data'    => $orderMyrInfo->toArray(),
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
        $orderMyrInfo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderMyrInfo,
            ]);
        }

        return view('orderMyrInfos.show', compact('orderMyrInfo'));
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
        $orderMyrInfo = $this->repository->find($id);

        return view('orderMyrInfos.edit', compact('orderMyrInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderMyrInfoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderMyrInfoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $orderMyrInfo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrderMyrInfo updated.',
                'data'    => $orderMyrInfo->toArray(),
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
                'message' => 'OrderMyrInfo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrderMyrInfo deleted.');
    }
}
