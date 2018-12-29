<!-- Supply Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supply_order_id', 'Supply Order Id:') !!}
		{!! Form::select('supply_order_id', $supplyOrders, null, ['class' => 'form-control']) !!}
</div>

<!-- Supply Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supply_id', 'Supply Id:') !!}
		{!! Form::select('supply_id', $supplies, null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('supplyOrderItems.index') !!}" class="btn btn-default">Cancel</a>
</div>
