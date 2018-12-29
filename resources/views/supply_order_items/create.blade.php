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
                    {!! Form::open(['route' => 'supplyOrderItems.store']) !!}

                        @include('supply_order_items.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
