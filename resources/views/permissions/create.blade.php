@extends('layouts.master')
@section('header')
<h1>
    Data Tables
    <small>advanced tables</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('permissions.index')}}">Permissions</a></li>
    <li class="active">Create Permission</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">All Permissions</h3>
                <a href="{{ route('permissions.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'permissions.store',
                ]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    {!! Form::label('name', Lang::get('permission.headers.name'), ['class' => 'control-label']) !!}
                    {!! Form::text('name', null,['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', Lang::get('permission.headers.description'), ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit(Lang::get('common.titles.save'), ['class' => 'btn btn-success']) !!}

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