@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Presentation
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($presentation, ['route' => ['presentations.update', $presentation->id], 'method' => 'patch']) !!}

                        @include('presentations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection