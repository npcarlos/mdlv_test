<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSupplyOrderAPIRequest;
use App\Http\Requests\API\UpdateSupplyOrderAPIRequest;
use App\Models\SupplyOrder;
use App\Repositories\SupplyOrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SupplyOrderController
 * @package App\Http\Controllers\API
 */

class SupplyOrderAPIController extends AppBaseController
{
    /** @var  SupplyOrderRepository */
    private $supplyOrderRepository;

    public function __construct(SupplyOrderRepository $supplyOrderRepo)
    {
        $this->supplyOrderRepository = $supplyOrderRepo;
    }

    /**
     * Display a listing of the SupplyOrder.
     * GET|HEAD /supplyOrders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyOrderRepository->pushCriteria(new RequestCriteria($request));
        $this->supplyOrderRepository->pushCriteria(new LimitOffsetCriteria($request));
        $supplyOrders = $this->supplyOrderRepository->all();

        return $this->sendResponse($supplyOrders->toArray(), 'Supply Orders retrieved successfully');
    }

    /**
     * Store a newly created SupplyOrder in storage.
     * POST /supplyOrders
     *
     * @param CreateSupplyOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyOrderAPIRequest $request)
    {
        $input = $request->all();

        $supplyOrders = $this->supplyOrderRepository->create($input);

        return $this->sendResponse($supplyOrders->toArray(), 'Supply Order saved successfully');
    }

    /**
     * Display the specified SupplyOrder.
     * GET|HEAD /supplyOrders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SupplyOrder $supplyOrder */
        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            return $this->sendError('Supply Order not found');
        }

        return $this->sendResponse($supplyOrder->toArray(), 'Supply Order retrieved successfully');
    }

    /**
     * Update the specified SupplyOrder in storage.
     * PUT/PATCH /supplyOrders/{id}
     *
     * @param  int $id
     * @param UpdateSupplyOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var SupplyOrder $supplyOrder */
        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            return $this->sendError('Supply Order not found');
        }

        $supplyOrder = $this->supplyOrderRepository->update($input, $id);

        return $this->sendResponse($supplyOrder->toArray(), 'SupplyOrder updated successfully');
    }

    /**
     * Remove the specified SupplyOrder from storage.
     * DELETE /supplyOrders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SupplyOrder $supplyOrder */
        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            return $this->sendError('Supply Order not found');
        }

        $supplyOrder->delete();

        return $this->sendResponse($id, 'Supply Order deleted successfully');
    }
}
