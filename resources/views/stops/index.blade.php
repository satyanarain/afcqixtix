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
               <?php $permission_status = checkPermission('stops','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen)
                        createButton('create','Add');
                    elseif($permission_status)
                        createDisableButton('create','Add');?>
            </div>
             @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Stop')</th>
                            <th>@lang('Stop ID')</th>
                            <th>@lang('Abbreviation')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stops as $value)
                        <tr class="nor_f    ">
                            <td>{{$value->stop}}</td>
                            <td>{{$value->stop_id}}
                            </td>
                            <td>{{$value->abbreviation}}
                            </td>
                            <td>
                                <?php $permission = getAllModulePermission('stops');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                <a href="<?php echo route('stops.edit',$value->id)?>" title="Edit Stop"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                <a style="cursor: pointer;" title="View Stop" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>
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
@include('partials.stopsheader')
@include('partials.table_script') 
@stop