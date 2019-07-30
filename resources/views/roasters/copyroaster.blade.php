@extends('layouts.master')
@section('header')
<h1>Copy Roster</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('roasters.index')}}">Roasters</a></li>
    <li class="active">Copy Roster</li>
</ol>
@stop
@section('content')
<div class="col-md-12 no-padding">
    <div class="callout callout-info">
        {{headingMain()}}
    </div>
</div>
<div class="col-md-12">
<div class="row">

        <div class="box box-default" style="min-height:0px;">
            <div class="box-header with-border">
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'roasters.storecopy',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                 'onSubmit'=>"return validateForm();"
                ]) !!}
                @include('roasters.copyform', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>

</div>
</div>        <!-- /.box -->

    <!-- /.col -->


@stop
