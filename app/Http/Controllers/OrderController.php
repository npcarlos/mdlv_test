<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Repositories\OrderRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use App\Models\Customer;
use App\Models\Seller;
use App\Models\PaymentStatus;
use App\Models\DeliveryStatus;
use App\Models\Deliverer;
use App\Models\DeliveryAddress;


class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderRepository->pushCriteria(new RequestCriteria($request));
        $orders = $this->orderRepository->all();

        return view('orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
		$customers = Customer::all()->pluck('labelSelect', 'id');
		$sellers = Seller::all()->pluck('labelSelect', 'id');
		$paymentStatuses = PaymentStatus::all()->pluck('labelSelect', 'id');
		$deliveryStatuses = DeliveryStatus::all()->pluck('labelSelect', 'id');
		$deliverers = Deliverer::all()->pluck('labelSelect', 'id');
		$deliveryAddresses = DeliveryAddress::all()->pluck('labelSelect', 'id');

		return view('orders.create', compact('customers', 'sellers', 'paymentStatuses', 'deliveryStatuses', 'deliverers', 'deliveryAddresses'));
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success('Order saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
		$customers = Customer::all()->pluck('labelSelect', 'id');
		$sellers = Seller::all()->pluck('labelSelect', 'id');
		$paymentStatuses = PaymentStatus::all()->pluck('labelSelect', 'id');
		$deliveryStatuses = DeliveryStatus::all()->pluck('labelSelect', 'id');
		$deliverers = Deliverer::all()->pluck('labelSelect', 'id');
		$deliveryAddresses = DeliveryAddress::all()->pluck('labelSelect', 'id');

        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

		return view('orders.edit', compact('order', 'customers', 'sellers', 'paymentStatuses', 'deliveryStatuses', 'deliverers', 'deliveryAddresses'));
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }
}
