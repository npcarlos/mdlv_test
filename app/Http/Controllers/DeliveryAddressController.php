<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDeliveryAddressRequest;
use App\Http\Requests\UpdateDeliveryAddressRequest;
use App\Repositories\DeliveryAddressRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Customer;


class DeliveryAddressController extends AppBaseController
{
    /** @var  DeliveryAddressRepository */
    private $deliveryAddressRepository;

    public function __construct(DeliveryAddressRepository $deliveryAddressRepo)
    {
        $this->deliveryAddressRepository = $deliveryAddressRepo;
    }

    /**
     * Display a listing of the DeliveryAddress.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->deliveryAddressRepository->pushCriteria(new RequestCriteria($request));
        $deliveryAddresses = $this->deliveryAddressRepository->all();

        return view('delivery_addresses.index')
            ->with('deliveryAddresses', $deliveryAddresses);
    }

    /**
     * Show the form for creating a new DeliveryAddress.
     *
     * @return Response
     */
    public function create()
    {
		$customers = Customer::all()->pluck('labelSelect', 'id');

		return view('delivery_addresses.create', compact('customers'));
    }

    /**
     * Store a newly created DeliveryAddress in storage.
     *
     * @param CreateDeliveryAddressRequest $request
     *
     * @return Response
     */
    public function store(CreateDeliveryAddressRequest $request)
    {
        $input = $request->all();

        $deliveryAddress = $this->deliveryAddressRepository->create($input);

        Flash::success('Delivery Address saved successfully.');

        return redirect(route('deliveryAddresses.index'));
    }

    /**
     * Display the specified DeliveryAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            Flash::error('Delivery Address not found');

            return redirect(route('deliveryAddresses.index'));
        }

        return view('delivery_addresses.show')->with('deliveryAddress', $deliveryAddress);
    }

    /**
     * Show the form for editing the specified DeliveryAddress.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$customers = Customer::all()->pluck('labelSelect', 'id');

        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            Flash::error('Delivery Address not found');

            return redirect(route('deliveryAddresses.index'));
        }

		return view('delivery_addresses.edit', compact('deliveryAddress', 'customers'));
    }

    /**
     * Update the specified DeliveryAddress in storage.
     *
     * @param  int              $id
     * @param UpdateDeliveryAddressRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDeliveryAddressRequest $request)
    {
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            Flash::error('Delivery Address not found');

            return redirect(route('deliveryAddresses.index'));
        }

        $deliveryAddress = $this->deliveryAddressRepository->update($request->all(), $id);

        Flash::success('Delivery Address updated successfully.');

        return redirect(route('deliveryAddresses.index'));
    }

    /**
     * Remove the specified DeliveryAddress from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliveryAddress = $this->deliveryAddressRepository->findWithoutFail($id);

        if (empty($deliveryAddress)) {
            Flash::error('Delivery Address not found');

            return redirect(route('deliveryAddresses.index'));
        }

        $this->deliveryAddressRepository->delete($id);

        Flash::success('Delivery Address deleted successfully.');

        return redirect(route('deliveryAddresses.index'));
    }
}
