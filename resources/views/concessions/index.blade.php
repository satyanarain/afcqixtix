@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li class="active">Concessions</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{getCurrentLabel('services','id',$service_id,'name')}} :-  {{headingMain()}}</h3>
               <?php $permission_status = checkPermission('concessions','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen){?>                     
                        <a href="{{route('bus_types.services.concessions.create',[$bus_type_id,$service_id])}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }elseif($permission_status)
                        createDisableButton('create','Add');?>
               
            </br>
            </br>
            <button  class="btn btn-primary pull-left"  onclick="orderList('order_id','order_list',{{$service_id}})"><span class="fa fa-sort-desc"></span>&nbsp;Update Order</button>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
          <input type="hidden" id="service_id" value="{{$service_id}}" disabled="disabled">
          <input type="hidden" id="bus_type_id" value="{{$bus_type_id}}" disabled="disabled">
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                         <tr>
<!--                            <th>@lang('Service Name')</th>-->
                            <th>@lang('Order Number')</th>
                           <th>@lang('Concession Provider')</th>
                            <th>@lang('Concession')</th>
                            <th>@lang('Description')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($concessions as $value)
                        <tr class="nor_f">
<!--                            <td>{{$value->name}}</td>-->
                             <td>{{$value->order_number}}</td>
                            <td>{{$value->concession_provider_master_id}}</td>
                            <td>{{$value->concession_master_id}}</td>
                            <td>{{$value->description}}</td>
                            <td>
                                 <?php $permission = getAllModulePermission('concessions');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('bus_types.services.concessions.edit',[$bus_type_id,$service_id,$value->id])?>" title="Edit Concession"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Concession Detail" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('partials.concession_order_header')
@include('partials.table_script_order')
@stop