<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOrderAPIRequest;
use App\Http\Requests\API\UpdateOrderAPIRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

use PDF;

use App\Models\Customer;
use App\Models\Presentation;
use App\Models\Product;
use App\Models\OrderItem;
/**
 * Class OrderController
 * @package App\Http\Controllers\API
 */

class OrderAPIController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
    }

    /**
     * Display a listing of the Order.
     * GET|HEAD /orders
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->orderRepository->pushCriteria(new RequestCriteria($request));
        $this->orderRepository->pushCriteria(new LimitOffsetCriteria($request));
        $orders = $this->orderRepository->with(['customer'])->all()->makeVisible(['created_at']);
//->with('orderItems', 'seller', 'customer')
        return $this->sendResponse($orders->toArray(), 'Orders retrieved successfully');
    }

    /**
     * Store a newly created Order in storage.
     * POST /orders
     *
     * @param CreateOrderAPIRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['customer_id'] = Customer::findByUUID($input['customer'])['id'];
        unset($input['customer']);
        $input['seller_id'] = $input['seller'];
        unset($input['seller']);
        $input['payment_status_id'] = 1;
        $input['delivery_status_id'] = 1;
        $input['deliverer_id'] = null;
        
        
        $orders = $this->orderRepository->create($input);
        
        $items = array();
        foreach ($input['cart'] as $cartItem)
        {
            $itemValues = [
                'order_id' => $orders->makeVisible('id')['id'],
                'presentation_id' => Presentation::findByUUID($cartItem['presentation'])['id'],
                'quantity' => $cartItem['requested_quantity'],
                'discount_id' => null
            ];
            
            $item = OrderItem::create($itemValues);
            array_push($items, $item);
        }
        $orders['items'] = $items;
        
        /*
        
        'planned_delivery_date',
        'delivery_date',
        'delivery_address_id',
        'comments'
        
        'order_id',
        'presentation_id',
        'quantity',
        'discount_id'

        $response = array();
        foreach ($input as $value) {
            $valores = [
                'requested_quantity'=>$value['cantidad'],
                'administrator_id' => 1,
                'presentation_id' => Presentation::where('uuid', $value['presentation'])->get()->makeVisible('id')[0]['id']
            ];
            
            $prelotOrder = PrelotOrder::create($valores);        
            array_push( $response, $prelotOrder);    
        }
*/
        

        return $this->sendResponse($orders->toArray(), 'Order saved successfully');
    }

    function generatePDF($uuid)
    {
        
        $order = Order::findByUUIDWith($uuid, ['orderItems', 'orderItems.presentation', 'orderItems.presentation.product', 'seller', 'customer', 'customer.documentType', 'paymentStatus', 'deliveryStatus', 'deliverer', 'deliveryAddress']);
        $data = ['title' => 'Welcome to '.$uuid, 'order' => $order];
        $pdf = PDF::loadView('myPDF', $data);
        
        return $pdf->stream('recibo.pdf');
    }
    /**
     * Display the specified Order.
     * GET|HEAD /orders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($uuid)
    {
        /** @var Order $order */
        //$order = $this->orderRepository->with(['orderItems', 'orderItems.presentation', 'seller', 'customer', 'paymentStatus', 'deliveryStatus', 'deliverer', 'deliveryAddress'])->findWithoutFail($id);
        $order = Order::findByUUIDWith($uuid, ['orderItems', 'orderItems.presentation', 'seller', 'customer', 'paymentStatus', 'deliveryStatus', 'deliverer', 'deliveryAddress']);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        return $this->sendResponse($order, 'Order retrieved successfully');
    }

    /**
     * Update the specified Order in storage.
     * PUT/PATCH /orders/{id}
     *
     * @param  int $id
     * @param UpdateOrderAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        $order = $this->orderRepository->update($input, $id);

        return $this->sendResponse($order->toArray(), 'Order updated successfully');
    }

    /**
     * Remove the specified Order from storage.
     * DELETE /orders/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Order $order */
        $order = $this->orderRepository->findWithoutFail($id);

        if (empty($order)) {
            return $this->sendError('Order not found');
        }

        $order->delete();

        return $this->sendResponse($id, 'Order deleted successfully');
    }
}
