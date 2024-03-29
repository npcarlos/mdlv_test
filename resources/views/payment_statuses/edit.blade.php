@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Payment Status
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($paymentStatus, ['route' => ['paymentStatuses.update', $paymentStatus->id], 'method' => 'patch']) !!}

                        @include('payment_statuses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection