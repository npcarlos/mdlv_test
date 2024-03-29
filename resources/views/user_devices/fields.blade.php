<!-- User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user', 'User:') !!}
    {!! Form::text('user', null, ['class' => 'form-control']) !!}
</div>

<!-- Token Field -->
<div class="form-group col-sm-6">
    {!! Form::label('token', 'Token:') !!}
    {!! Form::text('token', null, ['class' => 'form-control']) !!}
</div>

<!-- Device Field -->
<div class="form-group col-sm-6">
    {!! Form::label('device', 'Device:') !!}
    {!! Form::text('device', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('userDevices.index') !!}" class="btn btn-default">Cancel</a>
</div>
