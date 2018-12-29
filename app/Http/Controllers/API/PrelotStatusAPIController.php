<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePrelotStatusAPIRequest;
use App\Http\Requests\API\UpdatePrelotStatusAPIRequest;
use App\Models\PrelotStatus;
use App\Repositories\PrelotStatusRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PrelotStatusController
 * @package App\Http\Controllers\API
 */

class PrelotStatusAPIController extends AppBaseController
{
    /** @var  PrelotStatusRepository */
    private $prelotStatusRepository;

    public function __construct(PrelotStatusRepository $prelotStatusRepo)
    {
        $this->prelotStatusRepository = $prelotStatusRepo;
    }

    /**
     * Display a listing of the PrelotStatus.
     * GET|HEAD /prelotStatuses
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->prelotStatusRepository->pushCriteria(new RequestCriteria($request));
        $this->prelotStatusRepository->pushCriteria(new LimitOffsetCriteria($request));
        $prelotStatuses = $this->prelotStatusRepository->all();

        return $this->sendResponse($prelotStatuses->toArray(), 'Prelot Statuses retrieved successfully');
    }

    /**
     * Store a newly created PrelotStatus in storage.
     * POST /prelotStatuses
     *
     * @param CreatePrelotStatusAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePrelotStatusAPIRequest $request)
    {
        $input = $request->all();

        $prelotStatuses = $this->prelotStatusRepository->create($input);

        return $this->sendResponse($prelotStatuses->toArray(), 'Prelot Status saved successfully');
    }

    /**
     * Display the specified PrelotStatus.
     * GET|HEAD /prelotStatuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PrelotStatus $prelotStatus */
        $prelotStatus = $this->prelotStatusRepository->findWithoutFail($id);

        if (empty($prelotStatus)) {
            return $this->sendError('Prelot Status not found');
        }

        return $this->sendResponse($prelotStatus->toArray(), 'Prelot Status retrieved successfully');
    }

    /**
     * Update the specified PrelotStatus in storage.
     * PUT/PATCH /prelotStatuses/{id}
     *
     * @param  int $id
     * @param UpdatePrelotStatusAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePrelotStatusAPIRequest $request)
    {
        $input = $request->all();

        /** @var PrelotStatus $prelotStatus */
        $prelotStatus = $this->prelotStatusRepository->findWithoutFail($id);

        if (empty($prelotStatus)) {
            return $this->sendError('Prelot Status not found');
        }

        $prelotStatus = $this->prelotStatusRepository->update($input, $id);

        return $this->sendResponse($prelotStatus->toArray(), 'PrelotStatus updated successfully');
    }

    /**
     * Remove the specified PrelotStatus from storage.
     * DELETE /prelotStatuses/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PrelotStatus $prelotStatus */
        $prelotStatus = $this->prelotStatusRepository->findWithoutFail($id);

        if (empty($prelotStatus)) {
            return $this->sendError('Prelot Status not found');
        }

        $prelotStatus->delete();

        return $this->sendResponse($id, 'Prelot Status deleted successfully');
    }
}
