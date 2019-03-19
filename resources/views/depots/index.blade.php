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
                        createButton('create','Add Depot');
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
                            <th>@lang('Depot Name')</th>
                            <th>@lang('Depot ID')</th>
                            <th>@lang('Short Name')</th>
                            <th>@lang('Service Name')</th>
                            <th>@lang('Depot Location')</th>
                          {{  actionHeading('Action', $newaction='') }}
                            
                          </tr>
                    </thead>
                    <tbody>
                        @foreach($depots as $value)
                        <tr class="nor_f">
                            <td class="display_none"></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->depot_id}}</td>
                            <td>{{$value->short_name}}</td>
                            <td>{{$value->service_name}}</td>
                            <td>{{$value->depot_location}}
                            </td>
                            <td>
                                <?php $permission = getAllModulePermission('depots');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('depots.edit',$value->id)?>" title="Edit Depot"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View Depot" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <?php $permission1 = getAllModulePermission('vehicles');
                                if(in_array('view',$permission1)){?>
                                <a href="<?php echo route('depots.vehicles.index',$value->id)?>" title="Manage Vehicle" class="" ><span class="fa fa-bus"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <?php $permission2 = getAllModulePermission('crews');
                                if(in_array('view',$permission2)){?>
                                <a href="<?php echo route('depots.crew.index',$value->id)?>" title="Manage Crew" class="" ><i class="glyphicon glyphicon-user"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('partials.depotsheader')
@stop

