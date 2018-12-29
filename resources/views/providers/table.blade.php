<table class="table table-responsive" id="providers-table">
    <thead>
        <tr>
            <th>Name</th>
        <th>Document Type Id</th>
        <th>Document Number</th>
        <th>Address</th>
        <th>Phone</th>
        <th>Cellphone</th>
        <th>Web</th>
        <th>Facebook Id</th>
        <th>Instagram Id</th>
        <th>Image</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($providers as $provider)
        <tr>
            <td>{!! $provider->name !!}</td>
            <td>{!! $provider->document_type_id !!}</td>
            <td>{!! $provider->document_number !!}</td>
            <td>{!! $provider->address !!}</td>
            <td>{!! $provider->phone !!}</td>
            <td>{!! $provider->cellphone !!}</td>
            <td>{!! $provider->web !!}</td>
            <td>{!! $provider->facebook_id !!}</td>
            <td>{!! $provider->instagram_id !!}</td>
            <td>{!! $provider->image !!}</td>
            <td>
                {!! Form::open(['route' => ['providers.destroy', $provider->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('providers.show', [$provider->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('providers.edit', [$provider->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>