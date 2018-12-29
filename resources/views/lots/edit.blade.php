@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Lot
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($lot, ['route' => ['lots.update', $lot->id], 'method' => 'patch']) !!}

                        @include('lots.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection