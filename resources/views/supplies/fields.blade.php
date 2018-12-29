<!-- Supply Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('supply_category_id', 'Supply Category Id:') !!}
    {!! Form::select('supply_category_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Provider Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_id', 'Provider Id:') !!}
    {!! Form::select('provider_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Measurement Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('measurement_quantity', 'Measurement Quantity:') !!}
    {!! Form::number('measurement_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Measurement Unit Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('measurement_unit_id', 'Measurement Unit Id:') !!}
    {!! Form::select('measurement_unit_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Minimum Stock Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('minimum_stock_quantity', 'Minimum Stock Quantity:') !!}
    {!! Form::number('minimum_stock_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock_quantity', 'Stock Quantity:') !!}
    {!! Form::number('stock_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Minimum Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('minimum_quantity', 'Minimum Quantity:') !!}
    {!! Form::number('minimum_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Unitary Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unitary_value', 'Unitary Value:') !!}
    {!! Form::number('unitary_value', null, ['class' => 'form-control']) !!}
</div>

<!-- Iva Field -->
<div class="form-group col-sm-6">
    {!! Form::label('iva', 'Iva:') !!}
    {!! Form::number('iva', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('supplies.index') !!}" class="btn btn-default">Cancel</a>
</div>
