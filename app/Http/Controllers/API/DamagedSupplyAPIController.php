<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDamagedSupplyAPIRequest;
use App\Http\Requests\API\UpdateDamagedSupplyAPIRequest;
use App\Models\DamagedSupply;
use App\Repositories\DamagedSupplyRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class DamagedSupplyController
 * @package App\Http\Controllers\API
 */

class DamagedSupplyAPIController extends AppBaseController
{
    /** @var  DamagedSupplyRepository */
    private $damagedSupplyRepository;

    public function __construct(DamagedSupplyRepository $damagedSupplyRepo)
    {
        $this->damagedSupplyRepository = $damagedSupplyRepo;
    }

    /**
     * Display a listing of the DamagedSupply.
     * GET|HEAD /damagedSupplies
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->damagedSupplyRepository->pushCriteria(new RequestCriteria($request));
        $this->damagedSupplyRepository->pushCriteria(new LimitOffsetCriteria($request));
        $damagedSupplies = $this->damagedSupplyRepository->all();

        return $this->sendResponse($damagedSupplies->toArray(), 'Damaged Supplies retrieved successfully');
    }

    /**
     * Store a newly created DamagedSupply in storage.
     * POST /damagedSupplies
     *
     * @param CreateDamagedSupplyAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateDamagedSupplyAPIRequest $request)
    {
        $input = $request->all();

        $damagedSupplies = $this->damagedSupplyRepository->create($input);

        return $this->sendResponse($damagedSupplies->toArray(), 'Damaged Supply saved successfully');
    }

    /**
     * Display the specified DamagedSupply.
     * GET|HEAD /damagedSupplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var DamagedSupply $damagedSupply */
        $damagedSupply = $this->damagedSupplyRepository->findWithoutFail($id);

        if (empty($damagedSupply)) {
            return $this->sendError('Damaged Supply not found');
        }

        return $this->sendResponse($damagedSupply->toArray(), 'Damaged Supply retrieved successfully');
    }

    /**
     * Update the specified DamagedSupply in storage.
     * PUT/PATCH /damagedSupplies/{id}
     *
     * @param  int $id
     * @param UpdateDamagedSupplyAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDamagedSupplyAPIRequest $request)
    {
        $input = $request->all();

        /** @var DamagedSupply $damagedSupply */
        $damagedSupply = $this->damagedSupplyRepository->findWithoutFail($id);

        if (empty($damagedSupply)) {
            return $this->sendError('Damaged Supply not found');
        }

        $damagedSupply = $this->damagedSupplyRepository->update($input, $id);

        return $this->sendResponse($damagedSupply->toArray(), 'DamagedSupply updated successfully');
    }

    /**
     * Remove the specified DamagedSupply from storage.
     * DELETE /damagedSupplies/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var DamagedSupply $damagedSupply */
        $damagedSupply = $this->damagedSupplyRepository->findWithoutFail($id);

        if (empty($damagedSupply)) {
            return $this->sendError('Damaged Supply not found');
        }

        $damagedSupply->delete();

        return $this->sendResponse($id, 'Damaged Supply deleted successfully');
    }
}
