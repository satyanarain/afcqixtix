@extends('layouts.master')
@section('header')
<h1>Manage Route Details</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/route_master">Routes</a></li>
    <li class="active">Route Details</li>
</ol>
@stop
@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">List of Route Details</h3>
               <?php $permission_status = checkPermission('routes','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen){?>
                        <a href="<?php echo route('route_master.routes.create',$route_master_id)?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                    <?php }elseif($permission_status){
                        createDisableButton('create','Add');
                    }?>
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Route')</th>
                           <th>@lang('Path')</th>
                           <th>@lang('Direction')</th>
                          {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($routes as $value)
                        <tr class="nor_f">
                            <td>{{$value->route}}</td>
                            <td>{{$value->route}}{{ucfirst(substr($value->direction,0,1))}} : {{displayIdBaseName('stops',$value->source,'stop')}} - {{displayIdBaseName('stops',$value->destination,'stop')}} via- {{displayIdBaseName('stops',$value->via,'stop')}}</td>
                            <td>{{$value->direction}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('routes');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                <a href="<?php echo route('route_master.routes.edit',[$route_master_id,$value->id])?>" title="Edit Routes"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                <a style="cursor: pointer;" title="View Routes" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
<div class="modal fade" id="view_detail" role="dialog">
 </div>
<script>
   function viewDetails(id,view_detail)
   {
   var urldata=   '/routes/' + view_detail + '/' +id;
  //  alert(urldata)
    $.ajax({
		type: "GET",
		url: urldata,
		cache: false,
		success: function(data){
              //  alert(data);
                 $("#" + view_detail).modal('show');
                  $("#"+view_detail).html(data);
		}
	});
  
   }
</script>

@include('partials.routesheader')
@include('partials.table_script')
@stop