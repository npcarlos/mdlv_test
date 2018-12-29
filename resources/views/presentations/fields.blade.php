<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', 'Product Id:') !!}
    {!! Form::select('product_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Short Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('short_name', 'Short Name:') !!}
    {!! Form::text('short_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Formal Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('formal_name', 'Formal Name:') !!}
    {!! Form::text('formal_name', null, ['class' => 'form-control']) !!}
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

<!-- Wholesale Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('wholesale_price', 'Wholesale Price:') !!}
    {!! Form::number('wholesale_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Retail Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('retail_price', 'Retail Price:') !!}
    {!! Form::number('retail_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Minimum Stock Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('minimum_stock_quantity', 'Minimum Stock Quantity:') !!}
    {!! Form::number('minimum_stock_quantity', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('presentations.index') !!}" class="btn btn-default">Cancel</a>
</div>
