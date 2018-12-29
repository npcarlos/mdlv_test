<table class="table table-responsive" id="orderItems-table">
    <thead>
        <tr>
            <th>Order Id</th>
        <th>Presentation Id</th>
        <th>Quantity</th>
        <th>Discount Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($orderItems as $orderItem)
        <tr>
            <td>{!! $orderItem->order_id !!}</td>
            <td>{!! $orderItem->presentation_id !!}</td>
            <td>{!! $orderItem->quantity !!}</td>
            <td>{!! $orderItem->discount_id !!}</td>
            <td>
                {!! Form::open(['route' => ['orderItems.destroy', $orderItem->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('orderItems.show', [$orderItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('orderItems.edit', [$orderItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>