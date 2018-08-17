@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li><a href="{{route('bus_types.services.pass_types.index',[$bus_type_id,$service_id])}}">Pass Types</a></li>
    <li class="active">Add Pass Type</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
   
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{headingMain()}}</h3>
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => ['bus_types.services.pass_types.store',$bus_type_id,$service_id],
                'files'=>true,
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('pass_types.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

