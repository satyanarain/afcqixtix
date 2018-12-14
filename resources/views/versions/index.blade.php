@extends('layouts.master')
@section('header')
<h1>Manage Version Control</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Version Control</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{headingMain()}}</h3>
               <?php $permission_status = checkPermission('versions','create');
                    if($permission_status && checkVersionOpen()){?>                     
<!--                    <a class="disabled"><span class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</span></a>-->
                <?php }else{?>
                    <a href="<?php echo route('versions.create')?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }?>
            </div>
             @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Version ID')</th>
                            <th>@lang('Download From')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Reason')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($versions as $value)
                        <tr class="nor_f    ">
                            <td>{{$value->id}}</td>
                            <td>{{$value->downloading_wef}}</td>
                            <td><?php if($value->version_status=='o'){echo 'Open';}else{echo 'Close';}?></td>
                            <td>{{$value->reason}}
                            </td>
                            <td>
                                <?php $permission = getAllModulePermission('versions');
                                if(in_array('edit',$permission)){?>
                                    <?php if($value->version_status=='o'){?>
                                    <a href="<?php echo route('versions.edit',$value->id)?>" title="Edit Version"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php }?>
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a href="versions/view_differences/<?=$value->id?>" title="View Version Differences"><span class="glyphicon glyphicon-search"></span></a>
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
@include('partials.versionheader') 
@stop