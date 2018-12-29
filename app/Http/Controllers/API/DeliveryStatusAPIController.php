<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeliveryStatusAPIRequest;
use App\Http\Requests\API\UpdateDeliveryStatusAPIRequest;
use App\Models\DeliveryStatus;
use App\Repositories\DeliveryStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DeliveryStatusController
 * @package App\Http\Controllers\API
 */

class DeliveryStatusAPIController extends AppBaseController
{
    /** @var  DeliveryStatusRepository */
    private $deliveryStatusRepository;

    public function __construct(DeliveryStatusRepository $deliveryStatusRepo)
    {
        $this->deliveryStatusRepository = $deliveryStatusRepo;
    }

    /**
     * Display a listing of the DeliveryStatus.
     * GET|HEAD /deliveryStatuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deliveryStatusRepository->pushCriteria(new RequestCriteria($request));
        $this->deliveryStatusRepository->pushCriteria(new LimitOffsetCriteria($request));
        $deliveryStatuses = $this->deliveryStatusRepository->all();

        return $this->sendResponse($deliveryStatuses->toArray(), 'Delivery Statuses retrieved successfully');
    }

    /**
     * Store a newly created DeliveryStatus in storage.
     * POST /deliveryStatuses
     *
     * @param CreateDeliveryStatusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryStatusAPIRequest $request)
    {
        $input = $request->all();

        $deliveryStatuses = $this->deliveryStatusRepository->create($input);

        return $this->sendResponse($deliveryStatuses->toArray(), 'Delivery Status saved successfully');
    }

    /**
     * Display the specified DeliveryStatus.
     * GET|HEAD /deliveryStatuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DeliveryStatus $deliveryStatus */
        $deliveryStatus = $this->deliveryStatusRepository->findWithoutFail($id);

        if (empty($deliveryStatus)) {
            return $this->sendError('Delivery Status not found');
        }

        return $this->sendResponse($deliveryStatus->toArray(), 'Delivery Status retrieved successfully');
    }

    /**
     * Update the specified DeliveryStatus in storage.
     * PUT/PATCH /deliveryStatuses/{id}
     *
     * @param  int $id
     * @param UpdateDeliveryStatusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliveryStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var DeliveryStatus $deliveryStatus */
        $deliveryStatus = $this->deliveryStatusRepository->findWithoutFail($id);

        if (empty($deliveryStatus)) {
            return $this->sendError('Delivery Status not found');
        }

        $deliveryStatus = $this->deliveryStatusRepository->update($input, $id);

        return $this->sendResponse($deliveryStatus->toArray(), 'DeliveryStatus updated successfully');
    }

    /**
     * Remove the specified DeliveryStatus from storage.
     * DELETE /deliveryStatuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DeliveryStatus $deliveryStatus */
        $deliveryStatus = $this->deliveryStatusRepository->findWithoutFail($id);

        if (empty($deliveryStatus)) {
            return $this->sendError('Delivery Status not found');
        }

        $deliveryStatus->delete();

        return $this->sendResponse($id, 'Delivery Status deleted successfully');
    }
}
