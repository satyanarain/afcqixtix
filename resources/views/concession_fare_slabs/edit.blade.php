@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li><a href="{{route('bus_types.services.concession_fare_slabs.index',[$bus_type_id,$service_id])}}">Concession Fare Slab</a></li>
    <li class="active">Update Concession Fare Slab</li>
</ol>
@stop
@section('content')
 @include('partials.form_header')
         {!! Form::model($concession_fare_slabs, [
        'method' => 'PATCH',
        'route' => ['bus_types.services.concession_fare_slabs.update',$bus_type_id,$service_id,$concession_fare_slabs->id],  
        'files'=>true,
        'class'=>'form-horizontal',
        'autocomplete'=>'0ff',
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('concession_fare_slabs.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
