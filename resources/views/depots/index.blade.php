
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
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th class="display_none"></th>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('Depot ID')</th>
                            <th>@lang('Short Name')</th>
                            <th>@lang('Service Name')</th>
                            <th>@lang('Depot Location')</th>
                          {{  actionHeading('Action', $newaction='') }}
                            
                          </tr>
                    </thead>
                    <tbody>
                        @foreach($depots as $value)
                        <tr class="nor_f">
                            <td class="display_none"></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->depot_id}}</td>
                            <td>{{$value->short_name}}</td>
                            <td>{{$value->service_name}}</td>
                            <td>{{$value->depot_location}}
                            </td>
                            <td>{{ actionEdit('edit',$value->id)}}
                                <a href="<?php echo route('depots.vehicles.index',$value->id)?>" title="Manage Vehicle" class="" ><span class="fa fa-bus"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="<?php echo route('depots.crew.index',$value->id)?>" title="Manage Crew" class="" ><i class="glyphicon glyphicon-user"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('partials.depotsheader')
@include('partials.table_script')
@stop

