@extends('layouts.master')
@section('header')
<h1>Duty Management {{--headingBold()--}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('route_master.index')}}">Routes</a></li>
    <li><a href="{{route('route_master.duties.index',$route_id)}}">Duties</a></li>
    <li class="active">Update Duty</li>
</ol>
@stop
@section('content')
<div class="col-md-12">
    <div class="callout callout-info">
        Duty Update
    </div>
</div>
<div class="row">
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
               {!! Form::model($duties, [
        'method' => 'PATCH',
        'route' => ['route_master.duties.update',$route_master_id,$duties->id],
        'files'=>true,
        'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('duties.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
