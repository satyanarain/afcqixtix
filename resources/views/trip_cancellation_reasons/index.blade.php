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
               <?php $permission_status = checkPermission('trip_cancellation_reasons','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen)
                        createButton('create','Add','Add'.'order_id');
                    elseif($permission_status)
                        createDisableButton('create','Add');?>
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                             <th>@lang('Order Number')</th>
                            <th>@lang('Trip Cancellation Reason')</th>
                           
                            <th>@lang('Short Reason')</th>
                            <th>@lang('Reason Description')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($trip_cancellation_reasons as $value)
                        <tr class="nor_f">
                            <td>{{$value->order_number}}</td>
                            <td>{{$value->trip_cancellation_reason_category_master_id}}</td>
                            
                             <td>{{$value->short_reason}}</td>
                            <td>{{$value->reason_description}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('trip_cancellation_reasons');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('trip_cancellation_reasons.edit',$value->id)?>" title="Edit Trip Cancellation Reason"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Trip Cancellation Reason" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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

@include('partials.trip_cancellation_reason_order_header')
@include('partials.table_script_order')
@stop
