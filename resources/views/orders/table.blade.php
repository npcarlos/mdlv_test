<table class="table table-responsive" id="orders-table">
    <thead>
        <tr>
            <th>Customer Id</th>
        <th>Seller Id</th>
        <th>Payment Status Id</th>
        <th>Delivery Status Id</th>
        <th>Deliverer Id</th>
        <th>Planned Delivery Date</th>
        <th>Delivery Date</th>
        <th>Delivery Address Id</th>
        <th>Comments</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{!! $order->customer_id !!}</td>
            <td>{!! $order->seller_id !!}</td>
            <td>{!! $order->payment_status_id !!}</td>
            <td>{!! $order->delivery_status_id !!}</td>
            <td>{!! $order->deliverer_id !!}</td>
            <td>{!! $order->planned_delivery_date !!}</td>
            <td>{!! $order->delivery_date !!}</td>
            <td>{!! $order->delivery_address_id !!}</td>
            <td>{!! $order->comments !!}</td>
            <td>
                {!! Form::open(['route' => ['orders.destroy', $order->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orders.show', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orders.edit', [$order->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>