<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDelivererAPIRequest;
use App\Http\Requests\API\UpdateDelivererAPIRequest;
use App\Models\Deliverer;
use App\Repositories\DelivererRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DelivererController
 * @package App\Http\Controllers\API
 */

class DelivererAPIController extends AppBaseController
{
    /** @var  DelivererRepository */
    private $delivererRepository;

    public function __construct(DelivererRepository $delivererRepo)
    {
        $this->delivererRepository = $delivererRepo;
    }

    /**
     * Display a listing of the Deliverer.
     * GET|HEAD /deliverers
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->delivererRepository->pushCriteria(new RequestCriteria($request));
        $this->delivererRepository->pushCriteria(new LimitOffsetCriteria($request));
        $deliverers = $this->delivererRepository->all();

        return $this->sendResponse($deliverers->toArray(), 'Deliverers retrieved successfully');
    }

    /**
     * Store a newly created Deliverer in storage.
     * POST /deliverers
     *
     * @param CreateDelivererAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDelivererAPIRequest $request)
    {
        $input = $request->all();

        $deliverers = $this->delivererRepository->create($input);

        return $this->sendResponse($deliverers->toArray(), 'Deliverer saved successfully');
    }

    /**
     * Display the specified Deliverer.
     * GET|HEAD /deliverers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Deliverer $deliverer */
        $deliverer = $this->delivererRepository->findWithoutFail($id);

        if (empty($deliverer)) {
            return $this->sendError('Deliverer not found');
        }

        return $this->sendResponse($deliverer->toArray(), 'Deliverer retrieved successfully');
    }

    /**
     * Update the specified Deliverer in storage.
     * PUT/PATCH /deliverers/{id}
     *
     * @param  int $id
     * @param UpdateDelivererAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDelivererAPIRequest $request)
    {
        $input = $request->all();

        /** @var Deliverer $deliverer */
        $deliverer = $this->delivererRepository->findWithoutFail($id);

        if (empty($deliverer)) {
            return $this->sendError('Deliverer not found');
        }

        $deliverer = $this->delivererRepository->update($input, $id);

        return $this->sendResponse($deliverer->toArray(), 'Deliverer updated successfully');
    }

    /**
     * Remove the specified Deliverer from storage.
     * DELETE /deliverers/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Deliverer $deliverer */
        $deliverer = $this->delivererRepository->findWithoutFail($id);

        if (empty($deliverer)) {
            return $this->sendError('Deliverer not found');
        }

        $deliverer->delete();

        return $this->sendResponse($id, 'Deliverer deleted successfully');
    }
}
