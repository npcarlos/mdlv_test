<!-- Supply Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supply_id', 'Supply Id:') !!}
    {!! Form::select('supply_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Prelot Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prelot_order_id', 'Prelot Order Id:') !!}
    {!! Form::select('prelot_order_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Damage Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('damage_description', 'Damage Description:') !!}
    {!! Form::textarea('damage_description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('damagedSupplies.index') !!}" class="btn btn-default">Cancel</a>
</div>
