<!-- Person Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('person_id', 'Person Id:') !!}
    {!! Form::select('person_id', ], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('sellers.index') !!}" class="btn btn-default">Cancel</a>
</div>
