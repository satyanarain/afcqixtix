@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li><a href="{{route('bus_types.services.concession_fare_slabs.index',[$bus_type_id,$service_id])}}">Concession Fare Slab</a></li>
    <li class="active">Add Concession Fare Slab</li>
</ol>
@stop
@section('content')
@include('partials.form_header')
                {!! Form::open([
                'route' => ['bus_types.services.concession_fare_slabs.store',$bus_type_id,$service_id],
                   'class'=>'form-horizontal',
                   'autocomplete'=>'0ff',
                'files'=>true,
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('concession_fare_slabs.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

