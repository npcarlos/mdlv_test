<table class="table table-responsive" id="paymentStatuses-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($paymentStatuses as $paymentStatus)
        <tr>
            <td>{!! $paymentStatus->name !!}</td>
            <td>
                {!! Form::open(['route' => ['paymentStatuses.destroy', $paymentStatus->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('paymentStatuses.show', [$paymentStatus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('paymentStatuses.edit', [$paymentStatus->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>