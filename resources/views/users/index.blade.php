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
             @if(Entrust::hasRole('administrator'))
                <a href="{{ route('users.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
           @endif
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
                           
                             <th>@lang('Action')</th>
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
                                <a  href="{{ route('users.edit', $user->id) }}" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span></a>
                                <a  class="btn btn-small btn-primary" href="{{ route('users.show', $user->id) }}" ><span class="glyphicon glyphicon-search"></span></a>
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
@include('partials.table_script')
@stop