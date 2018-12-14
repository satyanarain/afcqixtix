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
               <?php $permission_status = checkPermission('denominations','create');
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
                            <th>@lang('Denomination Type')</th>
                            <th>@lang('Description')</th>
                            <th>@lang('Price')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($denominations as $value)
                        <tr class="nor_f">
                            <td>{{$value->denomination_master_id}}</td>
                             <td>{{$value->description}}</td>
                            <td>{{$value->price}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('denominations');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                <a href="<?php echo route('denominations.edit',$value->id)?>" title="Edit Denomination"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                <a style="cursor: pointer;" title="View Denomination" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('partials.denominationsheader')
@stop
