<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePrelotOrderRequest;
use App\Http\Requests\UpdatePrelotOrderRequest;
use App\Repositories\PrelotOrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class PrelotOrderController extends AppBaseController
{
    /** @var  PrelotOrderRepository */
    private $prelotOrderRepository;

    public function __construct(PrelotOrderRepository $prelotOrderRepo)
    {
        $this->prelotOrderRepository = $prelotOrderRepo;
    }

    /**
     * Display a listing of the PrelotOrder.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->prelotOrderRepository->pushCriteria(new RequestCriteria($request));
        $prelotOrders = $this->prelotOrderRepository->all();

        return view('prelot_orders.index')
            ->with('prelotOrders', $prelotOrders);
    }

    /**
     * Show the form for creating a new PrelotOrder.
     *
     * @return Response
     */
    public function create()
    {
        return view('prelot_orders.create');
    }

    /**
     * Store a newly created PrelotOrder in storage.
     *
     * @param CreatePrelotOrderRequest $request
     *
     * @return Response
     */
    public function store(CreatePrelotOrderRequest $request)
    {
        $input = $request->all();

        $prelotOrder = $this->prelotOrderRepository->create($input);

        Flash::success('Prelot Order saved successfully.');

        return redirect(route('prelotOrders.index'));
    }

    /**
     * Display the specified PrelotOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $prelotOrder = $this->prelotOrderRepository->findWithoutFail($id);

        if (empty($prelotOrder)) {
            Flash::error('Prelot Order not found');

            return redirect(route('prelotOrders.index'));
        }

        return view('prelot_orders.show')->with('prelotOrder', $prelotOrder);
    }

    /**
     * Show the form for editing the specified PrelotOrder.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $prelotOrder = $this->prelotOrderRepository->findWithoutFail($id);

        if (empty($prelotOrder)) {
            Flash::error('Prelot Order not found');

            return redirect(route('prelotOrders.index'));
        }

        return view('prelot_orders.edit')->with('prelotOrder', $prelotOrder);
    }

    /**
     * Update the specified PrelotOrder in storage.
     *
     * @param  int              $id
     * @param UpdatePrelotOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePrelotOrderRequest $request)
    {
        $prelotOrder = $this->prelotOrderRepository->findWithoutFail($id);

        if (empty($prelotOrder)) {
            Flash::error('Prelot Order not found');

            return redirect(route('prelotOrders.index'));
        }

        $prelotOrder = $this->prelotOrderRepository->update($request->all(), $id);

        Flash::success('Prelot Order updated successfully.');

        return redirect(route('prelotOrders.index'));
    }

    /**
     * Remove the specified PrelotOrder from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $prelotOrder = $this->prelotOrderRepository->findWithoutFail($id);

        if (empty($prelotOrder)) {
            Flash::error('Prelot Order not found');

            return redirect(route('prelotOrders.index'));
        }

        $this->prelotOrderRepository->delete($id);

        Flash::success('Prelot Order deleted successfully.');

        return redirect(route('prelotOrders.index'));
    }
}
