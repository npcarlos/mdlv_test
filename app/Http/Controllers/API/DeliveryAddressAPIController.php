<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDeliveryAddressAPIRequest;
use App\Http\Requests\API\UpdateDeliveryAddressAPIRequest;
use App\Models\DeliveryAddress;
use App\Repositories\DeliveryAddressRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DeliveryAddressController
 * @package App\Http\Controllers\API
 */

class DeliveryAddressAPIController extends AppBaseController
{
    /** @var  DeliveryAddressRepository */
    private $deliveryAddressRepository;

    public function __construct(DeliveryAddressRepository $deliveryAddressRepo)
    {
        $this->deliveryAddressRepository = $deliveryAddressRepo;
    }

    /**
     * Display a listing of the DeliveryAddress.
     * GET|HEAD /deliveryAddresses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deliveryAddressRepository->pushCriteria(new RequestCriteria($request));
        $this->deliveryAddressRepository->pushCriteria(new LimitOffsetCriteria($request));
        $deliveryAddresses = $this->deliveryAddressRepository->all();

        return $this->sendResponse($deliveryAddresses->toArray(), 'Delivery Addresses retrieved successfully');
    }

    /**
     * Store a newly created DeliveryAddress in storage.
     * POST /deliveryAddresses
     *
     * @param CreateDeliveryAddressAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryAddressAPIRequest $request)
    {
        $input = $request->all();

        $deliveryAddresses = $this->deliveryAddressRepository->create($input);

        return $this->sendResponse($deliveryAddresses->toArray(), 'Delivery Address saved successfully');
    }

    /**
     * Display the specified DeliveryAddress.
     * GET|HEAD /deliveryAddresses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DeliveryAddress $deliveryAddress */
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            return $this->sendError('Delivery Address not found');
        }

        return $this->sendResponse($deliveryAddress->toArray(), 'Delivery Address retrieved successfully');
    }

    /**
     * Update the specified DeliveryAddress in storage.
     * PUT/PATCH /deliveryAddresses/{id}
     *
     * @param  int $id
     * @param UpdateDeliveryAddressAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliveryAddressAPIRequest $request)
    {
        $input = $request->all();

        /** @var DeliveryAddress $deliveryAddress */
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            return $this->sendError('Delivery Address not found');
        }

        $deliveryAddress = $this->deliveryAddressRepository->update($input, $id);

        return $this->sendResponse($deliveryAddress->toArray(), 'DeliveryAddress updated successfully');
    }

    /**
     * Remove the specified DeliveryAddress from storage.
     * DELETE /deliveryAddresses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DeliveryAddress $deliveryAddress */
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            return $this->sendError('Delivery Address not found');
        }

        $deliveryAddress->delete();

        return $this->sendResponse($id, 'Delivery Address deleted successfully');
    }
}
