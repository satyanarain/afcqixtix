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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('role.headers.name')</th>
                            <th>@lang('role.headers.description')</th>
                            <th>@lang('role.headers.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{$role->display_name}}</td>
                            <td>{{Str_limit($role->description, 50)}}</td>

                            <td>   {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['roles.destroy', $role->id]
                                ]); !!}
                                @if($role->id !== 1)
                                {!! Form::submit(Lang::get('role.headers.delete'), ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?")']); !!}
                                @endif
                                {!! Form::close(); !!}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<script>
    $(function () {
        $("#example1").DataTable();

    });
</script>  
@stop