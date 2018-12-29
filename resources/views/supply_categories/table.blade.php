<table class="table table-responsive" id="supplyCategories-table">
    <thead>
        <tr>
            <th>Name</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($supplyCategories as $supplyCategory)
        <tr>
            <td>{!! $supplyCategory->name !!}</td>
            <td>
                {!! Form::open(['route' => ['supplyCategories.destroy', $supplyCategory->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('supplyCategories.show', [$supplyCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('supplyCategories.edit', [$supplyCategory->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>