@extends('layouts.master')
@section('header')
<h1>Role and Permission Management {{--headingBold()--}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
         <h3 class="box-title">List of All Role and Permissions</h3>
         <?php $permission_status = checkPermission('permissions','create');
         if($permission_status)
            createButton('create','Add');
        ?>
    </div>
    @include('partials.message')
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Description</th>
                    {{  actionHeading('Action', $newaction='') }}
                </tr>
            </thead>
            <tbody>
                @foreach($users as $value)
                <tr>
                    <td>{{$value->role}}</td>
                    <td>{{$value->description}}</td>
                    <td>
                        <?php $permission = getAllModulePermission('permissions');
                        if(in_array('edit',$permission)){?>
                            <a href="<?php echo route('permissions.edit',$value->id)?>" title="Edit Permission"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php }
                        if(in_array('view',$permission)){?>
                            <a style="cursor: pointer;" title="View Permission" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
@include('partials.menuheader')
@include('partials.table_script') 
@stop