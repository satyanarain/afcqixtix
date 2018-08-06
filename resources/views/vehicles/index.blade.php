@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/depots">Depots</a></li>
    <li class="active">Vehicles</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{getCurrentLabel('depots','id',$depot_id,'name')}} :- List of All Vehicles</h3>
                <a href="<?php echo route('depots.vehicles.create',$depot_id)?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
            </div>
            @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
<!--                            <th>@lang('Depot Name')</th>-->
                            <th>@lang('Vehicle Registration Number')</th>
                            <th>@lang('Bus Type')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($vehicles as $value)
                        <tr class="nor_f">
<!--                            <td>{{$value->name}}</td>-->
                            <td>{{$value->vehicle_registration_number}}
                            </td>
                            <td>{{$value->bus_type}}
                            </td>
                            <td>
                                <a href="<?php echo route('depots.vehicles.edit',[$depot_id,$value->id])?>" title="Edit Vehicle"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a style="cursor: pointer;" title="View" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>
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
@include('partials.vehiclesheader')
@include('partials.table_script') 
@stop