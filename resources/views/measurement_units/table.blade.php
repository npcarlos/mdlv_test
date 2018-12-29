<table class="table table-responsive" id="measurementUnits-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Abreviation</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($measurementUnits as $measurementUnit)
        <tr>
            <td>{!! $measurementUnit->name !!}</td>
            <td>{!! $measurementUnit->abreviation !!}</td>
            <td>
                {!! Form::open(['route' => ['measurementUnits.destroy', $measurementUnit->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('measurementUnits.show', [$measurementUnit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('measurementUnits.edit', [$measurementUnit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>