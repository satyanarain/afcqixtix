@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/route_master/">Routes</a></li>
    <li><a href="{{route('route_master.duties.index',$route_master_id,$duty_id)}}">Duty</a></li>
    <li><a href="{{route('route_master.duties.trips.index',[$route_master_id,$duty_id])}}">Trips</a></li>
    <li class="active">Add Trip</li>
</ol>
@stop
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="callout callout-info">
        {{headingMain()}}
    </div>
</div>
<div class="col-md-10 col-md-offset-1" style="min-height:10px;">
            <div class="box box-default" style="min-height:0px;">
                <div class="box-header with-border">
                    <h3 class="box-title">
                    </h3>
                    <div class="box-tools pull-right">
                        <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
                    {!! Form::open([
                    'route' => ['route_master.duties.trips.store',$route_master_id,$duty_id],
                    'files'=>true,
                    'enctype' => 'multipart/form-data',
                    'id'=>'create-form',
                    'class'=>'form-horizontal',
                    'autocomplete'=>'off'
                    ]) !!}
                    <!-- Warranty -->
                    @include('trips.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])
                     {!! Form::close() !!}
                </div>
            </div>
        </div>


@stop

