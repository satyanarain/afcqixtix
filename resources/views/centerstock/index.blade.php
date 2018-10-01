@extends('layouts.master')
@section('header')
<h1>Manage Center Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Inventories</a></li>
  <li><a href="/centerstock" class="active">Center Stock</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">Center Stock Inventories Details </h3>
               <?php 
                $permission_status = checkPermission('centerstock','create');
                if($permission_status)
                    createButton('create','Add Main Stock');
                elseif($permission_status)
                     createDisableButton('create','Add');?>
             </div>
            @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Items')</th>
                            <th>@lang('Denominations')</th>
                            <th>@lang('Series')</th>
                            <th>@lang('Start Sequence')</th>
                            <th>@lang('End Sequence')</th>
                            <th>@lang('Quantity')</th>
                            <th>@lang('Vender_name')</th>
                            <th>@lang('Date Received')</th>
                            <th>@lang('Challan Number')</th>
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($centerstock as $value)
                        <tr class="nor_f">
                            <td>{{$value->name}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->series}}</td>
                            <td>{{$value->start_sequence}}</td>
                            <td>{{$value->end_sequence}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>{{$value->vender_name}}</td>
                            <td>{{$value->date_received}}</td>
                            <td>{{$value->challan_no}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('bus_types');
                                if(in_array('edit',$permission)){
                                    echo '<a  href="'.route("centerstock.edit",$value->id).'" class="" title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                }elseif(in_array('edit',$permission)){?>
                                        <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission))
                                    echo '<a style="cursor: pointer;" title="View" data-toggle="modal" data-target="#'.$value->id.'"  onclick="viewDetails('.$value->id.',\'view_detail\')"><span class="glyphicon glyphicon-search"></span></a>';
                                ?>
                                <?php $permission = getAllModulePermission('services');
                                if(in_array('view',$permission)){?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo route('bus_types.services.index',$value->id)?>" title="Manage Services" class="" ><span class="fa fa-briefcase"></span></a>
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
 </div>

<!-- /.row -->

@include('partials.bustypes_order_header')
@include('partials.table_script_order')
@stop