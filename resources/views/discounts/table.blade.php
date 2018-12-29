<table class="table table-responsive" id="discounts-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Discount Percentage</th>
        <th>Comments</th>
        <th>Initial Date</th>
        <th>Final Date</th>
        <th>Image</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($discounts as $discount)
        <tr>
            <td>{!! $discount->name !!}</td>
            <td>{!! $discount->discount_percentage !!}</td>
            <td>{!! $discount->comments !!}</td>
            <td>{!! $discount->initial_date !!}</td>
            <td>{!! $discount->final_date !!}</td>
            <td>{!! $discount->image !!}</td>
            <td>
                {!! Form::open(['route' => ['discounts.destroy', $discount->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('discounts.show', [$discount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('discounts.edit', [$discount->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>