@extends('layouts.master')
@section('header')
<h1>
    Data Tables
    <small>advanced tables</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Permissions</li>
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
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('permission.headers.name')</th>
                            <th>@lang('permission.headers.description')</th>
                            <th>@lang('permission.headers.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->display_name}}</td>
                            <td>{{Str_limit($permission->description, 50)}}</td>

                            <td>   {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['permissions.destroy', $permission->id]
                                ]); !!}
                                @if($permission->id !== 1)
                                {!! Form::submit(Lang::get('permission.headers.delete'), ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Are you sure?")']); !!}
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