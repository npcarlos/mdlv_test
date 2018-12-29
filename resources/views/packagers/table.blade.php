<table class="table table-responsive" id="packagers-table">
    <thead>
        <tr>
            <th>Person Id</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($packagers as $packager)
        <tr>
            <td>{!! $packager->person_id !!}</td>
            <td>
                {!! Form::open(['route' => ['packagers.destroy', $packager->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('packagers.show', [$packager->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('packagers.edit', [$packager->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>