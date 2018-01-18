@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')

<div class="row">
    <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
            <h3 class="box-title">{{headingMain()}}</h3>
<!--                <a href="{{ route('permissions.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>-->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>User Name</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $value)
                        <tr>
                            <td>{{$value->name}}</td>
                            <td>{{$value->user_name}}</td>
                            <td> <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#<?php echo $value->id ?>"><span class="glyphicon glyphicon-search"></span>&nbsp;Menu</button></td>
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

@include('partials.menuheader')
@include('partials.table_script') 
@stop