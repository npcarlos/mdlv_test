<table class="table table-responsive" id="prelotOrders-table">
    <thead>
        <tr>
            <th>Presentation Id</th>
        <th>Packager Id</th>
        <th>Prelot Status Id</th>
        <th>Requested Quantity</th>
        <th>Real Quantity</th>
        <th>Planned Packaging Date</th>
        <th>Packaged Date</th>
        <th>Comments</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($prelotOrders as $prelotOrder)
        <tr>
            <td>{!! $prelotOrder->presentation_id !!}</td>
            <td>{!! $prelotOrder->packager_id !!}</td>
            <td>{!! $prelotOrder->prelot_status_id !!}</td>
            <td>{!! $prelotOrder->requested_quantity !!}</td>
            <td>{!! $prelotOrder->real_quantity !!}</td>
            <td>{!! $prelotOrder->planned_packaging_date !!}</td>
            <td>{!! $prelotOrder->packaged_date !!}</td>
            <td>{!! $prelotOrder->comments !!}</td>
            <td>
                {!! Form::open(['route' => ['prelotOrders.destroy', $prelotOrder->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('prelotOrders.show', [$prelotOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('prelotOrders.edit', [$prelotOrder->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>