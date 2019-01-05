<!-- Presentation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('presentation_id', 'Presentation Id:') !!}
		{!! Form::select('presentation_id', $presentations, null, ['class' => 'form-control']) !!}
</div>

<!-- Packager Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('packager_id', 'Packager Id:') !!}
		{!! Form::select('packager_id', $packagers, null, ['class' => 'form-control']) !!}
</div>

<!-- Prelot Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prelot_status_id', 'Prelot Status Id:') !!}
		{!! Form::select('prelot_status_id', $prelotStatuses, null, ['class' => 'form-control']) !!}
</div>

<!-- Requested Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('requested_quantity', 'Requested Quantity:') !!}
    {!! Form::number('requested_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Real Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('real_quantity', 'Real Quantity:') !!}
    {!! Form::number('real_quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Planned Packaging Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('planned_packaging_date', 'Planned Packaging Date:') !!}
    {!! Form::date('planned_packaging_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Packaged Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('packaged_date', 'Packaged Date:') !!}
    {!! Form::date('packaged_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Administrator Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('administrator_id', 'Administrator Id:') !!}
		{!! Form::select('administrator_id', $administrators, null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('prelotOrders.index') !!}" class="btn btn-default">Cancel</a>
</div>
