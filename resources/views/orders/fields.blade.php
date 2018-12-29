<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', 'Customer Id:') !!}
		{!! Form::select('customer_id', $customers, null, ['class' => 'form-control']) !!}
</div>

<!-- Seller Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seller_id', 'Seller Id:') !!}
		{!! Form::select('seller_id', $sellers, null, ['class' => 'form-control']) !!}
</div>

<!-- Deliverer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('deliverer_id', 'Deliverer Id:') !!}
		{!! Form::select('deliverer_id', $deliverers, null, ['class' => 'form-control']) !!}
</div>

<!-- Planned Delivery Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('planned_delivery_date', 'Planned Delivery Date:') !!}
    {!! Form::date('planned_delivery_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_date', 'Delivery Date:') !!}
    {!! Form::date('delivery_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Delivery Address Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('delivery_address_id', 'Delivery Address Id:') !!}
		{!! Form::select('delivery_address_id', $deliveryAddresses, null, ['class' => 'form-control']) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orders.index') !!}" class="btn btn-default">Cancel</a>
</div>
