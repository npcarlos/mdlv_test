@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Supply Order Item
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($supplyOrderItem, ['route' => ['supplyOrderItems.update', $supplyOrderItem->id], 'method' => 'patch']) !!}

                        @include('supply_order_items.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection