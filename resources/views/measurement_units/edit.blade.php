@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Measurement Unit
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($measurementUnit, ['route' => ['measurementUnits.update', $measurementUnit->id], 'method' => 'patch']) !!}

                        @include('measurement_units.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection