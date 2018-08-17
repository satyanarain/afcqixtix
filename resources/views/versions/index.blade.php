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
               <a href="<?php echo route('versions.create')?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
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
                                <?php if($value->version_status=='o'){?>
                                <a href="<?php echo route('versions.edit',$value->id)?>" title="Edit Version"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }?>
                                <a style="cursor: pointer;" title="View Version Detail" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>
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
@include('partials.table_script') 
@stop