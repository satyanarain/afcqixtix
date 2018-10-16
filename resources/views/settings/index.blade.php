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
               <?php $permission_status = checkPermission('settings','create');
                    if($permission_status){?>                     
                        <a href="<?php echo route('settings.create')?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }?>
               
            </div>
             @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Configuration Name')</th>
                            <th>@lang('Configuration Value')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $value)
                        <tr class="nor_f    ">
                            <td>{{$value->setting_description}}</td>
                            <td>{{$value->setting_value}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('settings');
                                if(in_array('edit',$permission)){?>
                                <a href="<?php echo route('settings.edit',$value->id)?>" title="Edit Setting"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }
                                if(in_array('view',$permission)){?>
                                <a style="cursor: pointer;" title="View Setting Detail" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>
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
@include('partials.settingheader')
@include('partials.table_script') 
@stop