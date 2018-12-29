<!-- Presentation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presentation_id', 'Presentation Id:') !!}
    {!! Form::select('presentation_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Packager Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('packager_id', 'Packager Id:') !!}
    {!! Form::select('packager_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Production Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('production_date', 'Production Date:') !!}
    {!! Form::date('production_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('lots.index') !!}" class="btn btn-default">Cancel</a>
</div>
