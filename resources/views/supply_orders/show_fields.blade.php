<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $supplyOrder->id !!}</p>
</div>

<!-- Uuid Field -->
<div class="form-group">
    {!! Form::label('uuid', 'Uuid:') !!}
    <p>{!! $supplyOrder->uuid !!}</p>
</div>

<!-- Provider Id Field -->
<div class="form-group">
    {!! Form::label('provider_id', 'Provider Id:') !!}
    <p>{!! $supplyOrder->provider_id !!}</p>
</div>

<!-- Administrator Id Field -->
<div class="form-group">
    {!! Form::label('administrator_id', 'Administrator Id:') !!}
    <p>{!! $supplyOrder->administrator_id !!}</p>
</div>

<!-- Comments Field -->
<div class="form-group">
    {!! Form::label('comments', 'Comments:') !!}
    <p>{!! $supplyOrder->comments !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $supplyOrder->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $supplyOrder->updated_at !!}</p>
</div>

