@extends('layouts.master')
@section('header')
<h1>Role and Permission Management {{--headingBold()--}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="col-md-12">
    <div class="callout callout-info">
        Role Update
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
               {!! Form::model($permissions, [
        'method' => 'PATCH',
        'route' => ['permissions.update', $permissions->id],
        'files'=>true,
        'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('permissions.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div> 

@stop
