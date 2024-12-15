<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\OrderRmbInfoCreateRequest;
use App\Http\Requests\OrderRmbInfoUpdateRequest;
use App\Repositories\OrderRmbInfoRepository;
use App\Validators\OrderRmbInfoValidator;

/**
 * Class OrderRmbInfosController.
 *
 * @package namespace App\Http\Controllers;
 */
class OrderRmbInfosController extends Controller
{
    /**
     * @var OrderRmbInfoRepository
     */
    protected $repository;

    /**
     * @var OrderRmbInfoValidator
     */
    protected $validator;

    /**
     * OrderRmbInfosController constructor.
     *
     * @param OrderRmbInfoRepository $repository
     * @param OrderRmbInfoValidator $validator
     */
    public function __construct(OrderRmbInfoRepository $repository, OrderRmbInfoValidator $validator)
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
        $orderRmbInfos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderRmbInfos,
            ]);
        }

        return view('orderRmbInfos.index', compact('orderRmbInfos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderRmbInfoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderRmbInfoCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $orderRmbInfo = $this->repository->create($request->all());

            $response = [
                'message' => 'OrderRmbInfo created.',
                'data'    => $orderRmbInfo->toArray(),
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
        $orderRmbInfo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $orderRmbInfo,
            ]);
        }

        return view('orderRmbInfos.show', compact('orderRmbInfo'));
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
        $orderRmbInfo = $this->repository->find($id);

        return view('orderRmbInfos.edit', compact('orderRmbInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderRmbInfoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderRmbInfoUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $orderRmbInfo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'OrderRmbInfo updated.',
                'data'    => $orderRmbInfo->toArray(),
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
                'message' => 'OrderRmbInfo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'OrderRmbInfo deleted.');
    }
}
