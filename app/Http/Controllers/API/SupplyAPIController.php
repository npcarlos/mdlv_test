<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSupplyAPIRequest;
use App\Http\Requests\API\UpdateSupplyAPIRequest;
use App\Models\Supply;
use App\Repositories\SupplyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SupplyController
 * @package App\Http\Controllers\API
 */

class SupplyAPIController extends AppBaseController
{
    /** @var  SupplyRepository */
    private $supplyRepository;

    public function __construct(SupplyRepository $supplyRepo)
    {
        $this->supplyRepository = $supplyRepo;
    }

    /**
     * Display a listing of the Supply.
     * GET|HEAD /supplies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyRepository->pushCriteria(new RequestCriteria($request));
        $this->supplyRepository->pushCriteria(new LimitOffsetCriteria($request));
        $supplies = $this->supplyRepository->all();

        return $this->sendResponse($supplies->toArray(), 'Supplies retrieved successfully');
    }

    /**
     * Store a newly created Supply in storage.
     * POST /supplies
     *
     * @param CreateSupplyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyAPIRequest $request)
    {
        $input = $request->all();

        $supplies = $this->supplyRepository->create($input);

        return $this->sendResponse($supplies->toArray(), 'Supply saved successfully');
    }

    /**
     * Display the specified Supply.
     * GET|HEAD /supplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Supply $supply */
        $supply = $this->supplyRepository->findWithoutFail($id);

        if (empty($supply)) {
            return $this->sendError('Supply not found');
        }

        return $this->sendResponse($supply->toArray(), 'Supply retrieved successfully');
    }

    /**
     * Update the specified Supply in storage.
     * PUT/PATCH /supplies/{id}
     *
     * @param  int $id
     * @param UpdateSupplyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyAPIRequest $request)
    {
        $input = $request->all();

        /** @var Supply $supply */
        $supply = $this->supplyRepository->findWithoutFail($id);

        if (empty($supply)) {
            return $this->sendError('Supply not found');
        }

        $supply = $this->supplyRepository->update($input, $id);

        return $this->sendResponse($supply->toArray(), 'Supply updated successfully');
    }

    /**
     * Remove the specified Supply from storage.
     * DELETE /supplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Supply $supply */
        $supply = $this->supplyRepository->findWithoutFail($id);

        if (empty($supply)) {
            return $this->sendError('Supply not found');
        }

        $supply->delete();

        return $this->sendResponse($id, 'Supply deleted successfully');
    }
}
