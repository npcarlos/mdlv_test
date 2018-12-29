@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Deliverer
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deliverer, ['route' => ['deliverers.update', $deliverer->id], 'method' => 'patch']) !!}

                        @include('deliverers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection