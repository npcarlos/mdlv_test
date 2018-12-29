<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMeasurementUnitAPIRequest;
use App\Http\Requests\API\UpdateMeasurementUnitAPIRequest;
use App\Models\MeasurementUnit;
use App\Repositories\MeasurementUnitRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MeasurementUnitController
 * @package App\Http\Controllers\API
 */

class MeasurementUnitAPIController extends AppBaseController
{
    /** @var  MeasurementUnitRepository */
    private $measurementUnitRepository;

    public function __construct(MeasurementUnitRepository $measurementUnitRepo)
    {
        $this->measurementUnitRepository = $measurementUnitRepo;
    }

    /**
     * Display a listing of the MeasurementUnit.
     * GET|HEAD /measurementUnits
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->measurementUnitRepository->pushCriteria(new RequestCriteria($request));
        $this->measurementUnitRepository->pushCriteria(new LimitOffsetCriteria($request));
        $measurementUnits = $this->measurementUnitRepository->all();

        return $this->sendResponse($measurementUnits->toArray(), 'Measurement Units retrieved successfully');
    }

    /**
     * Store a newly created MeasurementUnit in storage.
     * POST /measurementUnits
     *
     * @param CreateMeasurementUnitAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMeasurementUnitAPIRequest $request)
    {
        $input = $request->all();

        $measurementUnits = $this->measurementUnitRepository->create($input);

        return $this->sendResponse($measurementUnits->toArray(), 'Measurement Unit saved successfully');
    }

    /**
     * Display the specified MeasurementUnit.
     * GET|HEAD /measurementUnits/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var MeasurementUnit $measurementUnit */
        $measurementUnit = $this->measurementUnitRepository->findWithoutFail($id);

        if (empty($measurementUnit)) {
            return $this->sendError('Measurement Unit not found');
        }

        return $this->sendResponse($measurementUnit->toArray(), 'Measurement Unit retrieved successfully');
    }

    /**
     * Update the specified MeasurementUnit in storage.
     * PUT/PATCH /measurementUnits/{id}
     *
     * @param  int $id
     * @param UpdateMeasurementUnitAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMeasurementUnitAPIRequest $request)
    {
        $input = $request->all();

        /** @var MeasurementUnit $measurementUnit */
        $measurementUnit = $this->measurementUnitRepository->findWithoutFail($id);

        if (empty($measurementUnit)) {
            return $this->sendError('Measurement Unit not found');
        }

        $measurementUnit = $this->measurementUnitRepository->update($input, $id);

        return $this->sendResponse($measurementUnit->toArray(), 'MeasurementUnit updated successfully');
    }

    /**
     * Remove the specified MeasurementUnit from storage.
     * DELETE /measurementUnits/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var MeasurementUnit $measurementUnit */
        $measurementUnit = $this->measurementUnitRepository->findWithoutFail($id);

        if (empty($measurementUnit)) {
            return $this->sendError('Measurement Unit not found');
        }

        $measurementUnit->delete();

        return $this->sendResponse($id, 'Measurement Unit deleted successfully');
    }
}
