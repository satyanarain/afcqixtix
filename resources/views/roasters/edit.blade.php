@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
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
                <div class="col-md-3">
                    {!! Form::label('dated_on', Lang::get('Dated On'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
                        : <?=date( 'd-m-Y', strtotime($roasters->dated_on))?>
                </div>
                <div class="col-md-3">
                    {!! Form::label('shift', Lang::get('Shift'), ['class' => 'control-label','style'=>"margin-bottom:10px;"]) !!}
                        : <?=$roasters->shift?>
                </div>
                
                <div class="col-md-12 col-sm-12 alert-danger cash-collection-error hide"></div>
                <div class="box-tools pull-right">
                    <button class="slideout-menu-toggle btn btn-box-tool btn-box-tool-lg" data-toggle="tooltip" title="Help"><i class="fa fa-question"></i></button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                
                
                {!! Form::model($roasters, [
                'method' => 'PATCH',
                'route' => ['roasters.update', $roasters->id],
                'files'=>true,
                'enctype' => 'multipart/form-data',
                 'class'=>'form-horizontal'
                ]) !!}
                @include('roasters.editform', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        
</div>
</div>        <!-- /.box -->

    <!-- /.col -->


@stop

