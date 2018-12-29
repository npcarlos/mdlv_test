<table class="table table-responsive" id="supplyOrderItems-table">
    <thead>
        <tr>
            <th>Supply Order Id</th>
        <th>Supply Id</th>
        <th>Quantity</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($supplyOrderItems as $supplyOrderItem)
        <tr>
            <td>{!! $supplyOrderItem->supply_order_id !!}</td>
            <td>{!! $supplyOrderItem->supply_id !!}</td>
            <td>{!! $supplyOrderItem->quantity !!}</td>
            <td>
                {!! Form::open(['route' => ['supplyOrderItems.destroy', $supplyOrderItem->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('supplyOrderItems.show', [$supplyOrderItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('supplyOrderItems.edit', [$supplyOrderItem->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>