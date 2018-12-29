<table class="table table-responsive" id="customers-table">
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
    @foreach($customers as $customer)
        <tr>
            <td>{!! $customer->name !!}</td>
            <td>{!! $customer->document_type_id !!}</td>
            <td>{!! $customer->document_number !!}</td>
            <td>{!! $customer->address !!}</td>
            <td>{!! $customer->phone !!}</td>
            <td>{!! $customer->cellphone !!}</td>
            <td>{!! $customer->web !!}</td>
            <td>{!! $customer->facebook_id !!}</td>
            <td>{!! $customer->instagram_id !!}</td>
            <td>{!! $customer->image !!}</td>
            <td>
                {!! Form::open(['route' => ['customers.destroy', $customer->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('customers.show', [$customer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('customers.edit', [$customer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>