<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', 'Order Id:') !!}
    {!! Form::select('order_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Presentation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presentation_id', 'Presentation Id:') !!}
    {!! Form::select('presentation_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount_id', 'Discount Id:') !!}
    {!! Form::select('discount_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('orderItems.index') !!}" class="btn btn-default">Cancel</a>
</div>
