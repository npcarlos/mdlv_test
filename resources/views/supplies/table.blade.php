<table class="table table-responsive" id="supplies-table">
    <thead>
        <tr>
            <th>Supply Category Id</th>
        <th>Name</th>
        <th>Provider Id</th>
        <th>Measurement Quantity</th>
        <th>Measurement Unit Id</th>
        <th>Minimum Stock Quantity</th>
        <th>Stock Quantity</th>
        <th>Minimum Quantity</th>
        <th>Unitary Value</th>
        <th>Iva</th>
        <th>Image</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($supplies as $supply)
        <tr>
            <td>{!! $supply->supply_category_id !!}</td>
            <td>{!! $supply->name !!}</td>
            <td>{!! $supply->provider_id !!}</td>
            <td>{!! $supply->measurement_quantity !!}</td>
            <td>{!! $supply->measurement_unit_id !!}</td>
            <td>{!! $supply->minimum_stock_quantity !!}</td>
            <td>{!! $supply->stock_quantity !!}</td>
            <td>{!! $supply->minimum_quantity !!}</td>
            <td>{!! $supply->unitary_value !!}</td>
            <td>{!! $supply->iva !!}</td>
            <td>{!! $supply->image !!}</td>
            <td>
                {!! Form::open(['route' => ['supplies.destroy', $supply->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('supplies.show', [$supply->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('supplies.edit', [$supply->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>