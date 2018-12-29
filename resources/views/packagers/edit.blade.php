@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Packager
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($packager, ['route' => ['packagers.update', $packager->id], 'method' => 'patch']) !!}

                        @include('packagers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection