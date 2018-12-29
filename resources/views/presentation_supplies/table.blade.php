<table class="table table-responsive" id="presentationSupplies-table">
    <thead>
        <tr>
            <th>Presentation Id</th>
        <th>Supply Id</th>
        <th>Quantity</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($presentationSupplies as $presentationSupplies)
        <tr>
            <td>{!! $presentationSupplies->presentation_id !!}</td>
            <td>{!! $presentationSupplies->supply_id !!}</td>
            <td>{!! $presentationSupplies->quantity !!}</td>
            <td>
                {!! Form::open(['route' => ['presentationSupplies.destroy', $presentationSupplies->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('presentationSupplies.show', [$presentationSupplies->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('presentationSupplies.edit', [$presentationSupplies->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>