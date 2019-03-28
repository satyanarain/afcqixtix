@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li><a href="{{route('bus_types.services.pass_types.index',[$bus_type_id,$service_id])}}">Pass Types</a></li>
    <li class="active">Update Pass Type</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="callout callout-info">
        {{headingMain()}}
    </div>
    </div>
    <div class="col-md-8 col-md-offset-2" style="min-height:10px;">
            <div class="box box-default" style="min-height:0px;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                    </h3>
                    <div class="box-tools pull-right">
                        <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
               {!! Form::model($pass_types, [
        'method' => 'PATCH',
        'route' => ['bus_types.services.pass_types.update',$bus_type_id,$service_id,$pass_types->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
        'class'=>'form-horizontal'
        ]) !!}
               @include('pass_types.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
