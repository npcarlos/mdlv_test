<table class="table table-responsive" id="deliveryAddresses-table">
    <thead>
        <tr>
            <th>Customer Id</th>
        <th>Address</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($deliveryAddresses as $deliveryAddress)
        <tr>
            <td>{!! $deliveryAddress->customer_id !!}</td>
            <td>{!! $deliveryAddress->address !!}</td>
            <td>
                {!! Form::open(['route' => ['deliveryAddresses.destroy', $deliveryAddress->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('deliveryAddresses.show', [$deliveryAddress->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('deliveryAddresses.edit', [$deliveryAddress->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>