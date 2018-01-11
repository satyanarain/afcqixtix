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
         {{ createButton('create','Add') }}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="display_none"></th>
                            <th>@lang('user.headers.name')</th>
                            <th>@lang('User Name')</th>
                            <th>@lang('user.headers.email')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="nor_f">
                            <th class="display_none"></th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a  href="{{ route('users.edit', $user->id) }}" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil">Edit</span></a>
                                <a  class="btn btn-small btn-primary" href="{{ route('users.show', $user->id) }}" ><span class="glyphicon glyphicon-search"></span>View</a>
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
@include('partials.routesheader')
@include('partials.table_script') 
@stop