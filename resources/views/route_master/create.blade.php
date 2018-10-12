@extends('layouts.master')
@section('header')
<h1>Manage Route Master</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('route_master.index')}}">Route Master</a></li>
    <li class="active">Create Route Master</li>
</ol>
@stop
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="callout callout-info">
        Create Route Master
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
                    {!! Form::open([
                    'route' => 'route_master.store',
                    'files'=>true,
                    'enctype' => 'multipart/form-data',
                    'id'=>'create-form',
                    'class'=>'form-horizontal',
                    'autocomplete'=>'off'
                    ]) !!}
                    <!-- Warranty -->
                    @include('route_master.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>


@stop

