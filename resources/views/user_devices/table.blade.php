<table class="table table-responsive" id="userDevices-table">
    <thead>
        <tr>
            <th>User</th>
        <th>Token</th>
        <th>Device</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($userDevices as $userDevice)
        <tr>
            <td>{!! $userDevice->user !!}</td>
            <td>{!! $userDevice->token !!}</td>
            <td>{!! $userDevice->device !!}</td>
            <td>
                {!! Form::open(['route' => ['userDevices.destroy', $userDevice->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('userDevices.show', [$userDevice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('userDevices.edit', [$userDevice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>