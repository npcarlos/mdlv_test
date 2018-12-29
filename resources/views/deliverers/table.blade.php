<table class="table table-responsive" id="deliverers-table">
    <thead>
        <tr>
            <th>Person Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($deliverers as $deliverer)
        <tr>
            <td>{!! $deliverer->person_id !!}</td>
            <td>
                {!! Form::open(['route' => ['deliverers.destroy', $deliverer->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('deliverers.show', [$deliverer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('deliverers.edit', [$deliverer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>