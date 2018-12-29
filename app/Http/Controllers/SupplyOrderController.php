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
        return view('supply_orders.create');
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
        $supplyOrder = $this->supplyOrderRepository->findWithoutFail($id);

        if (empty($supplyOrder)) {
            Flash::error('Supply Order not found');

            return redirect(route('supplyOrders.index'));
        }

        return view('supply_orders.edit')->with('supplyOrder', $supplyOrder);
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
