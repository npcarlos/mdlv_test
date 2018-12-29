<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupplyOrderItemRequest;
use App\Http\Requests\UpdateSupplyOrderItemRequest;
use App\Repositories\SupplyOrderItemRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class SupplyOrderItemController extends AppBaseController
{
    /** @var  SupplyOrderItemRepository */
    private $supplyOrderItemRepository;

    public function __construct(SupplyOrderItemRepository $supplyOrderItemRepo)
    {
        $this->supplyOrderItemRepository = $supplyOrderItemRepo;
    }

    /**
     * Display a listing of the SupplyOrderItem.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->supplyOrderItemRepository->pushCriteria(new RequestCriteria($request));
        $supplyOrderItems = $this->supplyOrderItemRepository->all();

        return view('supply_order_items.index')
            ->with('supplyOrderItems', $supplyOrderItems);
    }

    /**
     * Show the form for creating a new SupplyOrderItem.
     *
     * @return Response
     */
    public function create()
    {
        return view('supply_order_items.create');
    }

    /**
     * Store a newly created SupplyOrderItem in storage.
     *
     * @param CreateSupplyOrderItemRequest $request
     *
     * @return Response
     */
    public function store(CreateSupplyOrderItemRequest $request)
    {
        $input = $request->all();

        $supplyOrderItem = $this->supplyOrderItemRepository->create($input);

        Flash::success('Supply Order Item saved successfully.');

        return redirect(route('supplyOrderItems.index'));
    }

    /**
     * Display the specified SupplyOrderItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $supplyOrderItem = $this->supplyOrderItemRepository->findWithoutFail($id);

        if (empty($supplyOrderItem)) {
            Flash::error('Supply Order Item not found');

            return redirect(route('supplyOrderItems.index'));
        }

        return view('supply_order_items.show')->with('supplyOrderItem', $supplyOrderItem);
    }

    /**
     * Show the form for editing the specified SupplyOrderItem.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $supplyOrderItem = $this->supplyOrderItemRepository->findWithoutFail($id);

        if (empty($supplyOrderItem)) {
            Flash::error('Supply Order Item not found');

            return redirect(route('supplyOrderItems.index'));
        }

        return view('supply_order_items.edit')->with('supplyOrderItem', $supplyOrderItem);
    }

    /**
     * Update the specified SupplyOrderItem in storage.
     *
     * @param  int              $id
     * @param UpdateSupplyOrderItemRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSupplyOrderItemRequest $request)
    {
        $supplyOrderItem = $this->supplyOrderItemRepository->findWithoutFail($id);

        if (empty($supplyOrderItem)) {
            Flash::error('Supply Order Item not found');

            return redirect(route('supplyOrderItems.index'));
        }

        $supplyOrderItem = $this->supplyOrderItemRepository->update($request->all(), $id);

        Flash::success('Supply Order Item updated successfully.');

        return redirect(route('supplyOrderItems.index'));
    }

    /**
     * Remove the specified SupplyOrderItem from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $supplyOrderItem = $this->supplyOrderItemRepository->findWithoutFail($id);

        if (empty($supplyOrderItem)) {
            Flash::error('Supply Order Item not found');

            return redirect(route('supplyOrderItems.index'));
        }

        $this->supplyOrderItemRepository->delete($id);

        Flash::success('Supply Order Item deleted successfully.');

        return redirect(route('supplyOrderItems.index'));
    }
}
