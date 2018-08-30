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
               <?php $permission_status = checkPermission('inspector_remarks','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen)
                        createButton('create','Add','Add'.'order_id');
                    elseif($permission_status)
                        createDisableButton('create','Add');?>
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                      
                           <th>@lang('Order Number')</th>
                            <th>@lang('Short Remarks')</th>
                            <th>@lang('Remarks Description')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($inspector_remarks as $value)
                        <tr class="nor_f">
                       
                            <td>{{$value->order_number}}</td>
                             <td>{{$value->short_remark}}</td>
                            <td>{{$value->remark_description}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('inspector_remarks');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('inspector_remarks.edit',$value->id)?>" title="Edit Inspector Remarks"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Inspector Remarks" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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

@include('partials.inspector_remark_order_header')
@include('partials.table_script_order')
@stop
