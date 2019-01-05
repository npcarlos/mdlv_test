@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            User Device
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($userDevice, ['route' => ['userDevices.update', $userDevice->id], 'method' => 'patch']) !!}

                        @include('user_devices.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection