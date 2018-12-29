<!-- Presentation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presentation_id', 'Presentation Id:') !!}
		{!! Form::select('presentation_id', $presentations, null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('presentationSupplies.index') !!}" class="btn btn-default">Cancel</a>
</div>
