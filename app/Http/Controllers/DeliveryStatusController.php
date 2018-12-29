<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeliveryStatusRequest;
use App\Http\Requests\UpdateDeliveryStatusRequest;
use App\Repositories\DeliveryStatusRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class DeliveryStatusController extends AppBaseController
{
    /** @var  DeliveryStatusRepository */
    private $deliveryStatusRepository;

    public function __construct(DeliveryStatusRepository $deliveryStatusRepo)
    {
        $this->deliveryStatusRepository = $deliveryStatusRepo;
    }

    /**
     * Display a listing of the DeliveryStatus.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deliveryStatusRepository->pushCriteria(new RequestCriteria($request));
        $deliveryStatuses = $this->deliveryStatusRepository->all();

        return view('delivery_statuses.index')
            ->with('deliveryStatuses', $deliveryStatuses);
    }

    /**
     * Show the form for creating a new DeliveryStatus.
     *
     * @return Response
     */
    public function create()
    {
        return view('delivery_statuses.create');
    }

    /**
     * Store a newly created DeliveryStatus in storage.
     *
     * @param CreateDeliveryStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryStatusRequest $request)
    {
        $input = $request->all();

        $deliveryStatus = $this->deliveryStatusRepository->create($input);

        Flash::success('Delivery Status saved successfully.');

        return redirect(route('deliveryStatuses.index'));
    }

    /**
     * Display the specified DeliveryStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliveryStatus = $this->deliveryStatusRepository->findWithoutFail($id);

        if (empty($deliveryStatus)) {
            Flash::error('Delivery Status not found');

            return redirect(route('deliveryStatuses.index'));
        }

        return view('delivery_statuses.show')->with('deliveryStatus', $deliveryStatus);
    }

    /**
     * Show the form for editing the specified DeliveryStatus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliveryStatus = $this->deliveryStatusRepository->findWithoutFail($id);

        if (empty($deliveryStatus)) {
            Flash::error('Delivery Status not found');

            return redirect(route('deliveryStatuses.index'));
        }

        return view('delivery_statuses.edit')->with('deliveryStatus', $deliveryStatus);
    }

    /**
     * Update the specified DeliveryStatus in storage.
     *
     * @param  int              $id
     * @param UpdateDeliveryStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliveryStatusRequest $request)
    {
        $deliveryStatus = $this->deliveryStatusRepository->findWithoutFail($id);

        if (empty($deliveryStatus)) {
            Flash::error('Delivery Status not found');

            return redirect(route('deliveryStatuses.index'));
        }

        $deliveryStatus = $this->deliveryStatusRepository->update($request->all(), $id);

        Flash::success('Delivery Status updated successfully.');

        return redirect(route('deliveryStatuses.index'));
    }

    /**
     * Remove the specified DeliveryStatus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliveryStatus = $this->deliveryStatusRepository->findWithoutFail($id);

        if (empty($deliveryStatus)) {
            Flash::error('Delivery Status not found');

            return redirect(route('deliveryStatuses.index'));
        }

        $this->deliveryStatusRepository->delete($id);

        Flash::success('Delivery Status deleted successfully.');

        return redirect(route('deliveryStatuses.index'));
    }
}
