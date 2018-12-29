@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Supply Category
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($supplyCategory, ['route' => ['supplyCategories.update', $supplyCategory->id], 'method' => 'patch']) !!}

                        @include('supply_categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection