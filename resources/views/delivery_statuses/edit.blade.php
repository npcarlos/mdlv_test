@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Delivery Status
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deliveryStatus, ['route' => ['deliveryStatuses.update', $deliveryStatus->id], 'method' => 'patch']) !!}

                        @include('delivery_statuses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection