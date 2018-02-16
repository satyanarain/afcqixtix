@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')

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
                    {!! Form::open([
                    'route' => 'fares.store',
                    'files'=>true,
                    'enctype' => 'multipart/form-data',
                    'id'=>'create-form',
                    'class'=>'form-horizontal'
                    ]) !!}
                    <!-- Warranty -->
                    @include('fares.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

@stop

