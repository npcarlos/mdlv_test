<table class="table table-responsive" id="prelotStatuses-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($prelotStatuses as $prelotStatus)
        <tr>
            <td>{!! $prelotStatus->name !!}</td>
            <td>
                {!! Form::open(['route' => ['prelotStatuses.destroy', $prelotStatus->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('prelotStatuses.show', [$prelotStatus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('prelotStatuses.edit', [$prelotStatus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>