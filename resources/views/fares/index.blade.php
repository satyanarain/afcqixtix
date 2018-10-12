@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li class="active">Fares</li>
</ol>
@stop
@section('content')

<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{getCurrentLabel('services','id',$service_id,'name')}} | {{headingMain()}}</h3>
                <?php $permission_status = checkPermission('fares','create');
                      $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen){?>                     
                        <a href="{{route('bus_types.services.fares.create',[$bus_type_id,$service_id])}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }elseif($permission_status)
                        createDisableButton('create','Add');?> 
                
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Stage')</th>
                            <th>@lang('Adult')</th>
                            <th>@lang('Child')</th>
                            <th>@lang('Luggage')</th>
                          {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($fares as $value)
                        <tr class="nor_f">
                            <td>{{$value->stage}}</td>
                            <td>{{$value->adult_ticket_amount}}</td>
                            <td>{{$value->child_ticket_amount}}</td>
                            <td>{{$value->luggage_ticket_amount}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('fares');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                <a href="<?php echo route('bus_types.services.fares.edit',[$bus_type_id,$service_id,$value->id])?>" title="Edit Service"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                <a style="cursor: pointer;" title="View Service" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
   var urldata=   '/fares/' + view_detail + '/' +id;
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

@include('partials.bustypesheader')
@include('partials.table_script')
@stop