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
               <?php $permission_status = checkPermission('depots','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen)
                        createButton('create','Add');
                    elseif($permission_status)
                        createDisableButton('create','Add');
                ?>
             </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th class="display_none"></th>
                            <th>@lang('Notification Type Name')</th>
                            <th>@lang('Name')</th>
                            <th>@lang('Email')</th>
                            
                          {{  actionHeading('Action', $newaction='') }}
                            
                          </tr>
                    </thead>
                    <tbody>
                        @foreach($notifications as $value)
                        <tr class="nor_f">
                            <td class="display_none"></td>
                            <td>{{$value->notifications_type_name}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->email}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('notifications');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('notifications.edit',$value->id)?>" title="Edit Notifications"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Notifications" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('partials.notificationsheader')
@stop

