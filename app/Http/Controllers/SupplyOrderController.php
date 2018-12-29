<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplyOrderRequest;
use App\Http\Requests\UpdateSupplyOrderRequest;
use App\Repositories\SupplyOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Provider;
use App\Models\Administrator;


class SupplyOrderController extends AppBaseController
{
    /** @var  SupplyOrderRepository */
    private $supplyOrderRepository;

    public function __construct(SupplyOrderRepository $supplyOrderRepo)
    {
        $this->supplyOrderRepository = $supplyOrderRepo;
    }

    /**
     * Display a listing of the SupplyOrder.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyOrderRepository->pushCriteria(new RequestCriteria($request));
        $supplyOrders = $this->supplyOrderRepository->all();

        return view('supply_orders.index')
            ->with('supplyOrders', $supplyOrders);
    }

    /**
     * Show the form for creating a new SupplyOrder.
     *
     * @return Response
     */
    public function create()
    {
		$providers = Provider::all()->pluck('labelSelect', 'id');
		$administrators = Administrator::all()->pluck('labelSelect', 'id');

		return view('supply_orders.create', compact('providers', 'administrators'));
    }

    /**
     * Store a newly created SupplyOrder in storage.
     *
     * @param CreateSupplyOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyOrderRequest $request)
    {
        $input = $request->all();

        $supplyOrder = $this->supplyOrderRepository->create($input);

        Flash::success('Supply Order saved successfully.');

        return redirect(route('supplyOrders.index'));
    }

    /**
     * Display the specified SupplyOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            Flash::error('Supply Order not found');

            return redirect(route('supplyOrders.index'));
        }

        return view('supply_orders.show')->with('supplyOrder', $supplyOrder);
    }

    /**
     * Show the form for editing the specified SupplyOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$providers = Provider::all()->pluck('labelSelect', 'id');
		$administrators = Administrator::all()->pluck('labelSelect', 'id');

        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            Flash::error('Supply Order not found');

            return redirect(route('supplyOrders.index'));
        }

		return view('supply_orders.edit', compact('supplyOrder', 'providers', 'administrators'));
    }

    /**
     * Update the specified SupplyOrder in storage.
     *
     * @param  int              $id
     * @param UpdateSupplyOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyOrderRequest $request)
    {
        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            Flash::error('Supply Order not found');

            return redirect(route('supplyOrders.index'));
        }

        $supplyOrder = $this->supplyOrderRepository->update($request->all(), $id);

        Flash::success('Supply Order updated successfully.');

        return redirect(route('supplyOrders.index'));
    }

    /**
     * Remove the specified SupplyOrder from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            Flash::error('Supply Order not found');

            return redirect(route('supplyOrders.index'));
        }

        $this->supplyOrderRepository->delete($id);

        Flash::success('Supply Order deleted successfully.');

        return redirect(route('supplyOrders.index'));
    }
}
