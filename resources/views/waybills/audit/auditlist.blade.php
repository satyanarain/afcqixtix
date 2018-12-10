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
               <?php $permission_status = checkPermission('etm_details','create');
                    if($permission_status)
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
                            <th>@lang('Date')</th>
                            <th>@lang('Shift')</th>
                            <th>@lang('Route Name')</th>
                            <th>@lang('Status')</th>
                              {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($waybills as $value)
                        <tr class="nor_f">
                            <th class="display_none"></th>
                            <td>{{$value->depot_name}}</td>
                            <td>{{$value->date}}</td>
                            <td>{{$value->shift}}</td>
                            <td>{{$value->route_name}}</td>
                            <td><?php if($value->status=="g"){echo 'Generated';}elseif($value->status=="s"){echo 'Submitted';}elseif($value->status=="c"){echo 'Audited & Closed';}?></td>
                            <td>
                                <?php $permission = getAllModulePermission('etm_details');
                                if(in_array('edit',$permission)){
                                    echo '<a  href="'.route("waybills.edit",$value->id).'" class="" title="Edit Waybill" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                    echo '<a  href="'.route("waybills.close",$value->id).'" class="" title="Submit Waybill" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                }
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
<!-- /.row -->
</div>
<div class="modal fade" id="view_detail" role="dialog"></div>
<script>
function viewDetails(id,view_detail)
   {
   var urldata=   '/waybills/' + view_detail + '/' +id;
    $.ajax({
		type: "GET",
		url: urldata,
		cache: false,
		success: function(data){
                  $("#" + view_detail).modal('show');
                  $("#"+view_detail).html(data);
		}
	});
  
   }
   
</script>
@include('partials.table_script')

@stop