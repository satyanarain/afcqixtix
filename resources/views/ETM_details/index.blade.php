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
               <?php $permission_status = checkPermission('ETM_details','create');
               $checkVersionOpen = checkVersionOpen();
                    if($permission_status && $checkVersionOpen)
                        createButton('create','Add');
                    elseif($permission_status)
                        createDisableButton('create','Add');
                ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="display_none"></th>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('ETM No.')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('SIM No.')</th>
                              {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ETM_details as $value)
                        <tr class="nor_f">
                            <th class="display_none"></th>
                            <td>{{$value->name}}</td>
                            <td>{{$value->etm_no}}</td>
                            <td>{{$value->evm_status_master_id}}</td>
                            <td>{{$value->sim_no}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('ETM_details');
                                if(in_array('edit',$permission) && $checkVersionOpen){
                                    echo '<a  href="'.route("ETM_details.edit",$value->id).'" class="" title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                }elseif(in_array('edit',$permission)){?>
                                    <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }
                                if(in_array('view',$permission))
                                    echo '<a style="cursor: pointer;" title="View" data-toggle="modal" data-target="#'.$value->id.'"  onclick="viewDetails('.$value->id.',\'view_detail\')"><span class="glyphicon glyphicon-search"></span></a>';
                                ?>
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
    url:'/user/statusupdate/'+id,
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
@include('partials.ETM_details_header')
@include('partials.table_script')

@stop