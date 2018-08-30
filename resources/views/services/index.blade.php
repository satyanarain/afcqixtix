@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li class="active">Services</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{getCurrentLabel('bus_types','id',$bus_type_id,'bus_type')}} :- {{headingMain()}}</h3>
                <?php $permission_status = checkPermission('services','create');
                      $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen){?>                     
                        <a href="<?php echo route('bus_types.services.create',$bus_type_id)?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }elseif($permission_status)
                        createDisableButton('create','Add');?> 
                 
                 </br>
            </br>
            <button  class="btn btn-primary pull-left"  onclick="orderList('order_id','order_list',{{$bus_type_id}})"><span class="fa fa-sort-desc"></span>&nbsp;Update Order</button>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
            <input type="hidden" id="bus_type_id" value="{{$bus_type_id}}" disabled="disabled">
            @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
<!--                            <th>@lang('Bus Type')</th>-->
                            <th>@lang('Service Name')</th>
                            <th>@lang('Order Number')</th>
                            <th>@lang('Short Name')</th>
                           {{  actionHeading('Action', $newaction='','') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $value)
                        <tr class="nor_f">
<!--                            <td>{{$value->bus_type}}</td>-->
                            <td>{{$value->name}}</td>
                            <td>{{$value->order_number}}</td>
                            <td>{{$value->short_name}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('services');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                <a href="<?php echo route('bus_types.services.edit',[$bus_type_id,$value->id])?>" title="Edit Service"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                <a style="cursor: pointer;" title="View Service" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
<!--                                <a style="cursor: pointer;" title="View {{$value->name}} Fare" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewServiceFares(<?php echo $value->id ?>,'view_detail');"><span class="fa fa-inr"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;-->
                                <?php }?>
                                <?php $permission1 = getAllModulePermission('fares');
                                if(in_array('view',$permission1)){?>
                                <a href="<?php echo route('bus_types.services.fares.index',[$bus_type_id,$value->id])?>" title="Manage {{$value->name}} Fare"><span class="fa fa-inr"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <?php $permission1 = getAllModulePermission('concession_fare_slabs');
                                if(in_array('view',$permission1)){?>
                                <a href="<?php echo route('bus_types.services.concession_fare_slabs.index',[$bus_type_id,$value->id])?>" title="Manage {{$value->name}} Concessions Fare Slab"><span class="fa fa-inr"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <?php $permission1 = getAllModulePermission('concessions');
                                if(in_array('view',$permission1)){?>
                                <a href="<?php echo route('bus_types.services.concessions.index',[$bus_type_id,$value->id])?>" title="Manage {{$value->name}} Concession"><span class="fa fa-inr"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <?php $permission1 = getAllModulePermission('pass_types');
                                if(in_array('view',$permission1)){?>
                                <a href="<?php echo route('bus_types.services.pass_types.index',[$bus_type_id,$value->id])?>" title="Manage {{$value->name}} Pass Types"><span class="fa fa-lock"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
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
@include('partials.services_order_header')

@include('partials.table_script_order')  
@stop