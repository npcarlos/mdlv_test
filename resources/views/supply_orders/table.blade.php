<table class="table table-responsive" id="supplyOrders-table">
    <thead>
        <tr>
            <th>Provider Id</th>
        <th>Administrator Id</th>
        <th>Comments</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($supplyOrders as $supplyOrder)
        <tr>
            <td>{!! $supplyOrder->provider_id !!}</td>
            <td>{!! $supplyOrder->administrator_id !!}</td>
            <td>{!! $supplyOrder->comments !!}</td>
            <td>
                {!! Form::open(['route' => ['supplyOrders.destroy', $supplyOrder->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('supplyOrders.show', [$supplyOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('supplyOrders.edit', [$supplyOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>