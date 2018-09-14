@extends('layouts.master')
@section('header')
<h1>
    Data Tables
    <small>advanced tables</small>
</h1>
@php  BreadCrumb(); @endphp
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
   
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Roles</h3>
                <a href="{{ route('roles.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'roles.store',
                ]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    {!! Form::label('name', Lang::get('role.headers.name'), ['class' => 'control-label']) !!}
                    {!! Form::text('name', null,['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', Lang::get('role.headers.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <div class="col-md-1" style="margin-left: 15px;">{!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}</div>
                <div class="col-md-3" style="margin-right: 15px;">{{ Form::button('Cancel', array('class' => 'btn btn-success pull-left','onclick'=>'window.history.back();')) }}</div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
@stop