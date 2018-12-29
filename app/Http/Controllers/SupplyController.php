<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplyRequest;
use App\Http\Requests\UpdateSupplyRequest;
use App\Repositories\SupplyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\SupplyCategory;
use App\Models\Provider;
use App\Models\MeasurementUnit;


class SupplyController extends AppBaseController
{
    /** @var  SupplyRepository */
    private $supplyRepository;

    public function __construct(SupplyRepository $supplyRepo)
    {
        $this->supplyRepository = $supplyRepo;
    }

    /**
     * Display a listing of the Supply.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyRepository->pushCriteria(new RequestCriteria($request));
        $supplies = $this->supplyRepository->all();

        return view('supplies.index')
            ->with('supplies', $supplies);
    }

    /**
     * Show the form for creating a new Supply.
     *
     * @return Response
     */
    public function create()
    {
		$supplyCategories = SupplyCategory::all()->pluck('labelSelect', 'id');
		$providers = Provider::all()->pluck('labelSelect', 'id');
		$measurementUnits = MeasurementUnit::all()->pluck('labelSelect', 'id');

		return view('supplies.create', compact('supplyCategories', 'providers', 'measurementUnits'));
    }

    /**
     * Store a newly created Supply in storage.
     *
     * @param CreateSupplyRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyRequest $request)
    {
        $input = $request->all();

        $supply = $this->supplyRepository->create($input);

        Flash::success('Supply saved successfully.');

        return redirect(route('supplies.index'));
    }

    /**
     * Display the specified Supply.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supply = $this->supplyRepository->findWithoutFail($id);

        if (empty($supply)) {
            Flash::error('Supply not found');

            return redirect(route('supplies.index'));
        }

        return view('supplies.show')->with('supply', $supply);
    }

    /**
     * Show the form for editing the specified Supply.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$supplyCategories = SupplyCategory::all()->pluck('labelSelect', 'id');
		$providers = Provider::all()->pluck('labelSelect', 'id');
		$measurementUnits = MeasurementUnit::all()->pluck('labelSelect', 'id');

        $supply = $this->supplyRepository->findWithoutFail($id);

        if (empty($supply)) {
            Flash::error('Supply not found');

            return redirect(route('supplies.index'));
        }

		return view('supplies.edit', compact('supply', 'supplyCategories', 'providers', 'measurementUnits'));
    }

    /**
     * Update the specified Supply in storage.
     *
     * @param  int              $id
     * @param UpdateSupplyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyRequest $request)
    {
        $supply = $this->supplyRepository->findWithoutFail($id);

        if (empty($supply)) {
            Flash::error('Supply not found');

            return redirect(route('supplies.index'));
        }

        $supply = $this->supplyRepository->update($request->all(), $id);

        Flash::success('Supply updated successfully.');

        return redirect(route('supplies.index'));
    }

    /**
     * Remove the specified Supply from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $supply = $this->supplyRepository->findWithoutFail($id);

        if (empty($supply)) {
            Flash::error('Supply not found');

            return redirect(route('supplies.index'));
        }

        $this->supplyRepository->delete($id);

        Flash::success('Supply deleted successfully.');

        return redirect(route('supplies.index'));
    }
}
