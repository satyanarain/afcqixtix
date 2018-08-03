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
         {{ createButton('create','Add') }}
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
                            {{ actionEdit('edit',$value->id)}}
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