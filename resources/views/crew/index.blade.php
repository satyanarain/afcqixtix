@extends('layouts.master')
@section('header')
<h1>Manage Depot Crew</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/depots">Depots</a></li>
    <li class="active">Crew</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{getCurrentLabel('depots','id',$depot_id,'name')}} | List of All Crew</h3>
               <?php $permission_status = checkPermission('crews','create');
                     $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen){?>                     
                        <a href="<?php echo route('depots.crew.create',$depot_id)?>"><button class="btn btn-afcs pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
                <?php }elseif($permission_status)
                        createDisableButton('create','Add');?>
               
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="display_none"></th>
<!--                            <th>@lang('Depot Name')</th>-->
                            <th>@lang('Crew Name')</th>
                            <th>@lang('Crew ID')</th>
                            <th>@lang('Role ')</th>
                           
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($crew_details as $value)
                        <tr class="nor_f">
                            <th class="display_none"></th>
<!--                            <td>{{$value->name}}</td>-->
                            <td>{{$value->crew_name}}</td>
                            <td>{{$value->crew_id}}</td>
                            <td>{{$value->role}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('crews');
                                if(in_array('edit',$permission) && $checkVersionOpen){?>
                                    <a href="<?php echo route('depots.crew.edit',[$depot_id,$value->id])?>" title="Edit Crew"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission)){?>
                                    <a style="cursor: pointer;" title="View" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>
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
<script>
function statusUpdate(id)
{
 $.ajax({
    type:'get',
    url:'/crew/statusupdate/'+id,
   success:function(data)
    {
   
    if(data==1)
    {
    $("#"+id).removeClass('btn-danger');   
    $("#"+id).addClass('btn-success');  
    $("#ai"+id).html('Active');    
    }else{
    $("#"+id).removeClass('btn-success');   
    $("#"+id).addClass('btn-danger');    
    $("#ai"+id).html('Inactive');    
    }
    
    }
});
}
</script>
<!-- /.row -->
@include('partials.crew_header')
@include('partials.table_script')

@stop