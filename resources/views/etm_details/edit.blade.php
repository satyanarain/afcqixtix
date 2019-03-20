@extends('layouts.master')
@section('header')
<h1>Manage ETM</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/etm_details">ETM</a></li>
    <li class="active">Update ETM</li>
</ol>
@stop
@section('content')
<div class="col-md-12">
    <div class="callout callout-info">
        Update ETM
    </div>
</div>
<div class="row">
    <div class="col-md-8 col-md-offset-2" style="min-height:10px;">
        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <h3 class="box-title">
                </h3>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
               {!! Form::model($etm_details, [
        'method' => 'PATCH',
        'route' => ['etm_details.update', $etm_details->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
         'class'=>'form-horizontal'
        ]) !!}
               @include('etm_details.form', ['submitButtonText' => Lang::get('etm_details.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
