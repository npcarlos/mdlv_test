<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateLotAPIRequest;
use App\Http\Requests\API\UpdateLotAPIRequest;
use App\Models\Lot;
use App\Repositories\LotRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class LotController
 * @package App\Http\Controllers\API
 */

class LotAPIController extends AppBaseController
{
    /** @var  LotRepository */
    private $lotRepository;

    public function __construct(LotRepository $lotRepo)
    {
        $this->lotRepository = $lotRepo;
    }

    /**
     * Display a listing of the Lot.
     * GET|HEAD /lots
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->lotRepository->pushCriteria(new RequestCriteria($request));
        $this->lotRepository->pushCriteria(new LimitOffsetCriteria($request));
        $lots = $this->lotRepository->all();

        return $this->sendResponse($lots->toArray(), 'Lots retrieved successfully');
    }

    /**
     * Store a newly created Lot in storage.
     * POST /lots
     *
     * @param CreateLotAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateLotAPIRequest $request)
    {
        $input = $request->all();

        $lots = $this->lotRepository->create($input);

        return $this->sendResponse($lots->toArray(), 'Lot saved successfully');
    }

    /**
     * Display the specified Lot.
     * GET|HEAD /lots/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Lot $lot */
        $lot = $this->lotRepository->findWithoutFail($id);

        if (empty($lot)) {
            return $this->sendError('Lot not found');
        }

        return $this->sendResponse($lot->toArray(), 'Lot retrieved successfully');
    }

    /**
     * Update the specified Lot in storage.
     * PUT/PATCH /lots/{id}
     *
     * @param  int $id
     * @param UpdateLotAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLotAPIRequest $request)
    {
        $input = $request->all();

        /** @var Lot $lot */
        $lot = $this->lotRepository->findWithoutFail($id);

        if (empty($lot)) {
            return $this->sendError('Lot not found');
        }

        $lot = $this->lotRepository->update($input, $id);

        return $this->sendResponse($lot->toArray(), 'Lot updated successfully');
    }

    /**
     * Remove the specified Lot from storage.
     * DELETE /lots/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Lot $lot */
        $lot = $this->lotRepository->findWithoutFail($id);

        if (empty($lot)) {
            return $this->sendError('Lot not found');
        }

        $lot->delete();

        return $this->sendResponse($id, 'Lot deleted successfully');
    }
}
