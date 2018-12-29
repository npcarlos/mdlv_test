<table class="table table-responsive" id="damagedSupplies-table">
    <thead>
        <tr>
            <th>Supply Id</th>
        <th>Prelot Order Id</th>
        <th>Quantity</th>
        <th>Damage Description</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($damagedSupplies as $damagedSupply)
        <tr>
            <td>{!! $damagedSupply->supply_id !!}</td>
            <td>{!! $damagedSupply->prelot_order_id !!}</td>
            <td>{!! $damagedSupply->quantity !!}</td>
            <td>{!! $damagedSupply->damage_description !!}</td>
            <td>
                {!! Form::open(['route' => ['damagedSupplies.destroy', $damagedSupply->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('damagedSupplies.show', [$damagedSupply->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('damagedSupplies.edit', [$damagedSupply->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>