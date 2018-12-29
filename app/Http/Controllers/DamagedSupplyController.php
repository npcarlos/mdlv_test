<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDamagedSupplyRequest;
use App\Http\Requests\UpdateDamagedSupplyRequest;
use App\Repositories\DamagedSupplyRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Supply;
use App\Models\PrelotOrder;


class DamagedSupplyController extends AppBaseController
{
    /** @var  DamagedSupplyRepository */
    private $damagedSupplyRepository;

    public function __construct(DamagedSupplyRepository $damagedSupplyRepo)
    {
        $this->damagedSupplyRepository = $damagedSupplyRepo;
    }

    /**
     * Display a listing of the DamagedSupply.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->damagedSupplyRepository->pushCriteria(new RequestCriteria($request));
        $damagedSupplies = $this->damagedSupplyRepository->all();

        return view('damaged_supplies.index')
            ->with('damagedSupplies', $damagedSupplies);
    }

    /**
     * Show the form for creating a new DamagedSupply.
     *
     * @return Response
     */
    public function create()
    {
		$supplies = Supply::all()->pluck('labelSelect', 'id');
		$prelotOrders = PrelotOrder::all()->pluck('labelSelect', 'id');

		return view('damaged_supplies.create', compact('supplies', 'prelotOrders'));
    }

    /**
     * Store a newly created DamagedSupply in storage.
     *
     * @param CreateDamagedSupplyRequest $request
     *
     * @return Response
     */
    public function store(CreateDamagedSupplyRequest $request)
    {
        $input = $request->all();

        $damagedSupply = $this->damagedSupplyRepository->create($input);

        Flash::success('Damaged Supply saved successfully.');

        return redirect(route('damagedSupplies.index'));
    }

    /**
     * Display the specified DamagedSupply.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $damagedSupply = $this->damagedSupplyRepository->findWithoutFail($id);

        if (empty($damagedSupply)) {
            Flash::error('Damaged Supply not found');

            return redirect(route('damagedSupplies.index'));
        }

        return view('damaged_supplies.show')->with('damagedSupply', $damagedSupply);
    }

    /**
     * Show the form for editing the specified DamagedSupply.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$supplies = Supply::all()->pluck('labelSelect', 'id');
		$prelotOrders = PrelotOrder::all()->pluck('labelSelect', 'id');

        $damagedSupply = $this->damagedSupplyRepository->findWithoutFail($id);

        if (empty($damagedSupply)) {
            Flash::error('Damaged Supply not found');

            return redirect(route('damagedSupplies.index'));
        }

		return view('damaged_supplies.edit', compact('damagedSupply', 'supplies', 'prelotOrders'));
    }

    /**
     * Update the specified DamagedSupply in storage.
     *
     * @param  int              $id
     * @param UpdateDamagedSupplyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDamagedSupplyRequest $request)
    {
        $damagedSupply = $this->damagedSupplyRepository->findWithoutFail($id);

        if (empty($damagedSupply)) {
            Flash::error('Damaged Supply not found');

            return redirect(route('damagedSupplies.index'));
        }

        $damagedSupply = $this->damagedSupplyRepository->update($request->all(), $id);

        Flash::success('Damaged Supply updated successfully.');

        return redirect(route('damagedSupplies.index'));
    }

    /**
     * Remove the specified DamagedSupply from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $damagedSupply = $this->damagedSupplyRepository->findWithoutFail($id);

        if (empty($damagedSupply)) {
            Flash::error('Damaged Supply not found');

            return redirect(route('damagedSupplies.index'));
        }

        $this->damagedSupplyRepository->delete($id);

        Flash::success('Damaged Supply deleted successfully.');

        return redirect(route('damagedSupplies.index'));
    }
}
