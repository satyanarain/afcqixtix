@extends('layouts.master')
@section('header')
<h1>Manage Route Master</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('route_master.index')}}">Route Master</a></li>
    <li class="active">Route Master Update</li>
</ol>
@stop
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="callout callout-info">
        Update Route Master
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
                   {!! Form::model($routes, [
        'method' => 'PATCH',
        'route' => ['route_master.update', $routes->id],
        'files'=>true,
        'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data',
         'autocomplete'=>'off'
        ]) !!}
                    <!-- Warranty -->
                    @include('route_master.form1', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
       

@stop

