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
               <?php $permission_status = checkPermission('payout_reasons','create');
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
                            <th>@lang('Short Reason')</th>
                            <th>@lang('Reason Description')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($payout_reasons as $value)
                        <tr class="nor_f">
                            
                            <td>{{$value->order_number}}</td>
                             <td>{{$value->short_reason}}</td>
                            <td>{{$value->reason_description}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('payout_reasons');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('payout_reasons.edit',$value->id)?>" title="Edit Payout Reason"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Payout Reason" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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

@include('partials.payout_reason_order_header')
@stop
