@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Prelot Status
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($prelotStatus, ['route' => ['prelotStatuses.update', $prelotStatus->id], 'method' => 'patch']) !!}

                        @include('prelot_statuses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection