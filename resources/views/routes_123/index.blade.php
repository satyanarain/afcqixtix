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
                            <th>@lang('Route')</th>
                            <th>@lang('Path')</th>
                            <th>@lang('Stop')</th>
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($routes as $value)
                        <tr class="nor_f">
                            <td>{{$value->route}}</td>
                            <td>{{$value->path}}
                            </td>
                            <td>{{$value->stop}}
                            </td>
                           
                         {{ actionEdit('edit',$value->id)}}
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