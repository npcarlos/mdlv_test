<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePrelotOrderAPIRequest;
use App\Http\Requests\API\UpdatePrelotOrderAPIRequest;
use App\Models\PrelotOrder;
use App\Repositories\PrelotOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PrelotOrderController
 * @package App\Http\Controllers\API
 */

class PrelotOrderAPIController extends AppBaseController
{
    /** @var  PrelotOrderRepository */
    private $prelotOrderRepository;

    public function __construct(PrelotOrderRepository $prelotOrderRepo)
    {
        $this->prelotOrderRepository = $prelotOrderRepo;
    }

    /**
     * Display a listing of the PrelotOrder.
     * GET|HEAD /prelotOrders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->prelotOrderRepository->pushCriteria(new RequestCriteria($request));
        $this->prelotOrderRepository->pushCriteria(new LimitOffsetCriteria($request));
        $prelotOrders = $this->prelotOrderRepository->all();

        return $this->sendResponse($prelotOrders->toArray(), 'Prelot Orders retrieved successfully');
    }

    /**
     * Store a newly created PrelotOrder in storage.
     * POST /prelotOrders
     *
     * @param CreatePrelotOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePrelotOrderAPIRequest $request)
    {
        $input = $request->all();

        $prelotOrders = $this->prelotOrderRepository->create($input);

        return $this->sendResponse($prelotOrders->toArray(), 'Prelot Order saved successfully');
    }

    /**
     * Display the specified PrelotOrder.
     * GET|HEAD /prelotOrders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PrelotOrder $prelotOrder */
        $prelotOrder = $this->prelotOrderRepository->findWithoutFail($id);

        if (empty($prelotOrder)) {
            return $this->sendError('Prelot Order not found');
        }

        return $this->sendResponse($prelotOrder->toArray(), 'Prelot Order retrieved successfully');
    }

    /**
     * Update the specified PrelotOrder in storage.
     * PUT/PATCH /prelotOrders/{id}
     *
     * @param  int $id
     * @param UpdatePrelotOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePrelotOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var PrelotOrder $prelotOrder */
        $prelotOrder = $this->prelotOrderRepository->findWithoutFail($id);

        if (empty($prelotOrder)) {
            return $this->sendError('Prelot Order not found');
        }

        $prelotOrder = $this->prelotOrderRepository->update($input, $id);

        return $this->sendResponse($prelotOrder->toArray(), 'PrelotOrder updated successfully');
    }

    /**
     * Remove the specified PrelotOrder from storage.
     * DELETE /prelotOrders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PrelotOrder $prelotOrder */
        $prelotOrder = $this->prelotOrderRepository->findWithoutFail($id);

        if (empty($prelotOrder)) {
            return $this->sendError('Prelot Order not found');
        }

        $prelotOrder->delete();

        return $this->sendResponse($id, 'Prelot Order deleted successfully');
    }
}
