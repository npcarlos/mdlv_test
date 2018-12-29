<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMeasurementUnitRequest;
use App\Http\Requests\UpdateMeasurementUnitRequest;
use App\Repositories\MeasurementUnitRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class MeasurementUnitController extends AppBaseController
{
    /** @var  MeasurementUnitRepository */
    private $measurementUnitRepository;

    public function __construct(MeasurementUnitRepository $measurementUnitRepo)
    {
        $this->measurementUnitRepository = $measurementUnitRepo;
    }

    /**
     * Display a listing of the MeasurementUnit.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->measurementUnitRepository->pushCriteria(new RequestCriteria($request));
        $measurementUnits = $this->measurementUnitRepository->all();

        return view('measurement_units.index')
            ->with('measurementUnits', $measurementUnits);
    }

    /**
     * Show the form for creating a new MeasurementUnit.
     *
     * @return Response
     */
    public function create()
    {
        return view('measurement_units.create');
    }

    /**
     * Store a newly created MeasurementUnit in storage.
     *
     * @param CreateMeasurementUnitRequest $request
     *
     * @return Response
     */
    public function store(CreateMeasurementUnitRequest $request)
    {
        $input = $request->all();

        $measurementUnit = $this->measurementUnitRepository->create($input);

        Flash::success('Measurement Unit saved successfully.');

        return redirect(route('measurementUnits.index'));
    }

    /**
     * Display the specified MeasurementUnit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $measurementUnit = $this->measurementUnitRepository->findWithoutFail($id);

        if (empty($measurementUnit)) {
            Flash::error('Measurement Unit not found');

            return redirect(route('measurementUnits.index'));
        }

        return view('measurement_units.show')->with('measurementUnit', $measurementUnit);
    }

    /**
     * Show the form for editing the specified MeasurementUnit.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $measurementUnit = $this->measurementUnitRepository->findWithoutFail($id);

        if (empty($measurementUnit)) {
            Flash::error('Measurement Unit not found');

            return redirect(route('measurementUnits.index'));
        }

        return view('measurement_units.edit')->with('measurementUnit', $measurementUnit);
    }

    /**
     * Update the specified MeasurementUnit in storage.
     *
     * @param  int              $id
     * @param UpdateMeasurementUnitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMeasurementUnitRequest $request)
    {
        $measurementUnit = $this->measurementUnitRepository->findWithoutFail($id);

        if (empty($measurementUnit)) {
            Flash::error('Measurement Unit not found');

            return redirect(route('measurementUnits.index'));
        }

        $measurementUnit = $this->measurementUnitRepository->update($request->all(), $id);

        Flash::success('Measurement Unit updated successfully.');

        return redirect(route('measurementUnits.index'));
    }

    /**
     * Remove the specified MeasurementUnit from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $measurementUnit = $this->measurementUnitRepository->findWithoutFail($id);

        if (empty($measurementUnit)) {
            Flash::error('Measurement Unit not found');

            return redirect(route('measurementUnits.index'));
        }

        $this->measurementUnitRepository->delete($id);

        Flash::success('Measurement Unit deleted successfully.');

        return redirect(route('measurementUnits.index'));
    }
}
