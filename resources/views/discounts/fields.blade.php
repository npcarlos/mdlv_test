<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Discount Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('discount_percentage', 'Discount Percentage:') !!}
    {!! Form::number('discount_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Comments Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comments', 'Comments:') !!}
    {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
</div>

<!-- Initial Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('initial_date', 'Initial Date:') !!}
    {!! Form::date('initial_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Final Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('final_date', 'Final Date:') !!}
    {!! Form::date('final_date', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('discounts.index') !!}" class="btn btn-default">Cancel</a>
</div>
