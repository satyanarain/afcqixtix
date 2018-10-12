@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/route_master">Routes</a></li>
    <li><a href="{{route('route_master.duties.index',$route_master_id,$duty_id)}}">Duties</a></li>
    <li class="active">Targets</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{getCurrentLabel('duties','id',$duty_id,'duty_number')}} | {{headingMain()}}</h3>
               <?php $permission_status = checkPermission('targets','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen){?>                     
                        <a href="<?php echo route('route_master.duties.targets.create',[$route_master_id,$duty_id])?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }elseif($permission_status)
                        createDisableButton('create','Add');?>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
<!--                            <th>@lang('Route')</th>-->
                            <th>@lang('Duty Number')</th>
                           <th>@lang('Start Time')</th>
                            <th>@lang('Shift')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($targets as $value)
                        <tr class="nor_f">
<!--                            <td>{{$value->route}}</td>-->
                            <td>{{$value->duty_number}}
                            </td>
                            <td>{{$value->start_time}}
                            </td>
                            
                            <td>{{$value->shift}}
                            </td>
                            <td>
                                <?php $permission = getAllModulePermission('targets');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('route_master.duties.targets.edit',[$route_master_id,$duty_id,$value->id])?>" title="Edit Target"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Trip" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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

@include('partials.targetsheader')
@include('partials.table_script')
@stop