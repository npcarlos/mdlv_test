@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Presentation Supplies
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'presentationSupplies.store']) !!}

                        @include('presentation_supplies.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
