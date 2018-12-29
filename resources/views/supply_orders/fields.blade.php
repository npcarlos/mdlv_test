<!-- Provider Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('provider_id', 'Provider Id:') !!}
		{!! Form::select('provider_id', $providers, null, ['class' => 'form-control']) !!}
</div>

<!-- Administrator Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('administrator_id', 'Administrator Id:') !!}
		{!! Form::select('administrator_id', $administrators, null, ['class' => 'form-control']) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('supplyOrders.index') !!}" class="btn btn-default">Cancel</a>
</div>
