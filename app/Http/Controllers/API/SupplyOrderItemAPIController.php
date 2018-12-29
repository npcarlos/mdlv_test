<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSupplyOrderItemAPIRequest;
use App\Http\Requests\API\UpdateSupplyOrderItemAPIRequest;
use App\Models\SupplyOrderItem;
use App\Repositories\SupplyOrderItemRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SupplyOrderItemController
 * @package App\Http\Controllers\API
 */

class SupplyOrderItemAPIController extends AppBaseController
{
    /** @var  SupplyOrderItemRepository */
    private $supplyOrderItemRepository;

    public function __construct(SupplyOrderItemRepository $supplyOrderItemRepo)
    {
        $this->supplyOrderItemRepository = $supplyOrderItemRepo;
    }

    /**
     * Display a listing of the SupplyOrderItem.
     * GET|HEAD /supplyOrderItems
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyOrderItemRepository->pushCriteria(new RequestCriteria($request));
        $this->supplyOrderItemRepository->pushCriteria(new LimitOffsetCriteria($request));
        $supplyOrderItems = $this->supplyOrderItemRepository->all();

        return $this->sendResponse($supplyOrderItems->toArray(), 'Supply Order Items retrieved successfully');
    }

    /**
     * Store a newly created SupplyOrderItem in storage.
     * POST /supplyOrderItems
     *
     * @param CreateSupplyOrderItemAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyOrderItemAPIRequest $request)
    {
        $input = $request->all();

        $supplyOrderItems = $this->supplyOrderItemRepository->create($input);

        return $this->sendResponse($supplyOrderItems->toArray(), 'Supply Order Item saved successfully');
    }

    /**
     * Display the specified SupplyOrderItem.
     * GET|HEAD /supplyOrderItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var SupplyOrderItem $supplyOrderItem */
        $supplyOrderItem = $this->supplyOrderItemRepository->findWithoutFail($id);

        if (empty($supplyOrderItem)) {
            return $this->sendError('Supply Order Item not found');
        }

        return $this->sendResponse($supplyOrderItem->toArray(), 'Supply Order Item retrieved successfully');
    }

    /**
     * Update the specified SupplyOrderItem in storage.
     * PUT/PATCH /supplyOrderItems/{id}
     *
     * @param  int $id
     * @param UpdateSupplyOrderItemAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyOrderItemAPIRequest $request)
    {
        $input = $request->all();

        /** @var SupplyOrderItem $supplyOrderItem */
        $supplyOrderItem = $this->supplyOrderItemRepository->findWithoutFail($id);

        if (empty($supplyOrderItem)) {
            return $this->sendError('Supply Order Item not found');
        }

        $supplyOrderItem = $this->supplyOrderItemRepository->update($input, $id);

        return $this->sendResponse($supplyOrderItem->toArray(), 'SupplyOrderItem updated successfully');
    }

    /**
     * Remove the specified SupplyOrderItem from storage.
     * DELETE /supplyOrderItems/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var SupplyOrderItem $supplyOrderItem */
        $supplyOrderItem = $this->supplyOrderItemRepository->findWithoutFail($id);

        if (empty($supplyOrderItem)) {
            return $this->sendError('Supply Order Item not found');
        }

        $supplyOrderItem->delete();

        return $this->sendResponse($id, 'Supply Order Item deleted successfully');
    }
}
