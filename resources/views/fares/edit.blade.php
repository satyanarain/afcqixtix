@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li><a href="{{route('bus_types.services.fares.index',[$bus_type_id,$service_id])}}">Fares</a></li>
    <li class="active">Update Fare</li>
</ol>
@stop
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="callout callout-info">
        {{headingMain()}}
    </div>
</div>
  <div class="col-md-8 col-md-offset-2">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">
                    </h3>
                    <div class="box-tools pull-right">
                        <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
                   {!! Form::model($fares, [
        'method' => 'PATCH',
        'route' => ['bus_types.services.fares.update',$bus_type_id,$service_id,$fare_details[0]->id],
        'files'=>true,
        'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data'
        ]) !!}
                    <!-- Warranty -->
                    @include('fares.form1', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
      

@stop

