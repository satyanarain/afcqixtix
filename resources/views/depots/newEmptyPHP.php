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
                <a href="{{ route('depots.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
           @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Short Name')</th>
                            <th>@lang('Depot Location')</th>
                             @if(Entrust::hasRole('administrator'))
                            <th>@lang('user.headers.edit')</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($depots as $depot)
                        <tr class="nor_f">
                            <td>{{$depot->name}}</td>
                            <td>{{$depot->short_name}}</td>
                            <td>{{$depot->depot_lacation}}</td>
                           <td> <a style="background-color:#3A485C" class="btn btn-success" href="{{ route('depots.show', $depot->id) }}"><span class="glyphicon glyphicon-search"></span>View</a>
                              @if(Entrust::hasRole('administrator'))
                            <td>
                                <a style="background-color:#f7831a" href="{{ route('depots.edit', $depot->id) }}" class="btn btn-success" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                            </td>
                            @endif
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
    </div>
    <!-- /.col -->

<!-- /.row -->

 
@stop