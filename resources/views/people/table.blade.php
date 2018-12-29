<table class="table table-responsive" id="people-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Lastname</th>
        <th>Password</th>
        <th>Document Type Id</th>
        <th>Document Number</th>
        <th>Phone</th>
        <th>Cellphone</th>
        <th>Address</th>
        <th>Nationality</th>
        <th>Picturethumbnail</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($people as $person)
        <tr>
            <td>{!! $person->name !!}</td>
            <td>{!! $person->lastname !!}</td>
            <td>{!! $person->password !!}</td>
            <td>{!! $person->document_type_id !!}</td>
            <td>{!! $person->document_number !!}</td>
            <td>{!! $person->phone !!}</td>
            <td>{!! $person->cellphone !!}</td>
            <td>{!! $person->address !!}</td>
            <td>{!! $person->nationality !!}</td>
            <td>{!! $person->pictureThumbnail !!}</td>
            <td>
                {!! Form::open(['route' => ['people.destroy', $person->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('people.show', [$person->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('people.edit', [$person->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>