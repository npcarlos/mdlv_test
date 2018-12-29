<table class="table table-responsive" id="presentations-table">
    <thead>
        <tr>
            <th>Product Id</th>
        <th>Short Name</th>
        <th>Formal Name</th>
        <th>Measurement Quantity</th>
        <th>Measurement Unit Id</th>
        <th>Wholesale Price</th>
        <th>Retail Price</th>
        <th>Minimum Stock Quantity</th>
        <th>Image</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($presentations as $presentation)
        <tr>
            <td>{!! $presentation->product_id !!}</td>
            <td>{!! $presentation->short_name !!}</td>
            <td>{!! $presentation->formal_name !!}</td>
            <td>{!! $presentation->measurement_quantity !!}</td>
            <td>{!! $presentation->measurement_unit_id !!}</td>
            <td>{!! $presentation->wholesale_price !!}</td>
            <td>{!! $presentation->retail_price !!}</td>
            <td>{!! $presentation->minimum_stock_quantity !!}</td>
            <td>{!! $presentation->image !!}</td>
            <td>
                {!! Form::open(['route' => ['presentations.destroy', $presentation->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('presentations.show', [$presentation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('presentations.edit', [$presentation->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>