@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Prelot Order
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($prelotOrder, ['route' => ['prelotOrders.update', $prelotOrder->id], 'method' => 'patch']) !!}

                        @include('prelot_orders.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection