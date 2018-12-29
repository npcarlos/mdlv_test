@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Supply
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($supply, ['route' => ['supplies.update', $supply->id], 'method' => 'patch']) !!}

                        @include('supplies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection