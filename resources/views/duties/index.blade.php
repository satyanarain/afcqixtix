@extends('layouts.master')
@section('header')
<h1>Duty Management {{--headingBold()--}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/route_master">Routes</a></li>
    <li class="active">Duties</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{getCurrentLabel('route_master','id',$route_master_id,'route_name')}} | List of All Duties</h3>
               <?php $permission_status = checkPermission('duties','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen){?>                     
                        <a href="<?php echo route('route_master.duties.create',$route_master_id)?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }elseif($permission_status)
                        createDisableButton('create','Add');?>
                
            </br>
            </br>
            <button  class="btn btn-primary pull-left"  onclick="orderList('order_id','order_list',{{$route_master_id}})"><span class="fa fa-sort-desc"></span>&nbsp;Update Order</button>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
          <input type="hidden" id="route_id" value="{{$route_master_id}}" disabled="disabled">
          @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example10" class="table table-bordered table-striped">
                    <thead>
                         <tr>
<!--                            <th>@lang('Route')</th>-->
                            <th>@lang('Order Number')</th>
                            <th>@lang('Duty Number')</th>
                           <th>@lang('Start Time')</th>
                           <th>@lang('End Time')</th>
                            <th>@lang('Shift')</th>
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($duties as $value)
                        <tr class="nor_f">
<!--                            <td>{{$value->route}}</td>-->
                            <td>{{$value->order_number}}</td>
                            <td>{{$value->duty_number}}</td>
                            <td>{{$value->start_time}}</td>
                            <td>{{$value->end_time}}</td>
                            <td>{{$value->shift}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('duties');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                <a href="<?php echo route('route_master.duties.edit',[$route_master_id,$value->id])?>" title="Edit Duty"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                <a style="cursor: pointer;" title="View Duty" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <?php $permission1 = getAllModulePermission('trips');
                                if(in_array('view',$permission1)){?>
                                <a href="<?php echo route('route_master.duties.trips.index',[$route_master_id,$value->id])?>" title="Manage {{$value->duty_number}} Trips"><span class="fa fa-tripadvisor"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <?php $permission2 = getAllModulePermission('targets');
                                if(in_array('view',$permission2)){?>
                                <a href="<?php echo route('route_master.duties.targets.index',[$route_master_id,$value->id])?>" title="Manage Targets" class="" ><span class="fa fa-bullseye"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('partials.duties_order_header')
@include('partials.table_script')
@stop