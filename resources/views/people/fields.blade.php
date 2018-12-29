<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Lastname:') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>

<!-- Birthday Field -->
<div class="form-group col-sm-6">
    {!! Form::label('birthday', 'Birthday:') !!}
    {!! Form::date('birthday', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Document Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document_type_id', 'Document Type Id:') !!}
		{!! Form::select('document_type_id', $documentTypes, null, ['class' => 'form-control']) !!}
</div>

<!-- Document Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('document_number', 'Document Number:') !!}
    {!! Form::text('document_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>

<!-- Cellphone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cellphone', 'Cellphone:') !!}
    {!! Form::text('cellphone', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Nationality Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nationality', 'Nationality:') !!}
    {!! Form::text('nationality', null, ['class' => 'form-control']) !!}
</div>

<!-- Picturelarge Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pictureLarge', 'Picturelarge:') !!}
    {!! Form::text('pictureLarge', null, ['class' => 'form-control']) !!}
</div>

<!-- Picturemedium Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pictureMedium', 'Picturemedium:') !!}
    {!! Form::text('pictureMedium', null, ['class' => 'form-control']) !!}
</div>

<!-- Picturethumbnail Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pictureThumbnail', 'Picturethumbnail:') !!}
    {!! Form::file('pictureThumbnail') !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('people.index') !!}" class="btn btn-default">Cancel</a>
</div>
