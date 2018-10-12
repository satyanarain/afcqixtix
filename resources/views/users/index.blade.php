@extends('layouts.master')
@section('header')
<h1>Manage Users</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">List of All Users</h3>
                <?php $permission_status = checkPermission('users','create');
                    if($permission_status)
                        createButton('create','Add');
                ?>    
                
            </div>
             @include('partials.message')
            <!-- /.box-header -->
            <div class="panel-body">
               <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="display_none"></th>
                            <th>@lang('user.headers.name')</th>
                            <th>@lang('User Name')</th>
                            <th>@lang('Role/Designation')</th>
                            <th>@lang('user.headers.email')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $value)
                        <tr class="nor_f">
                            <th class="display_none"></th>
                            <td>{{$value->name}}</td>
                            <td>{{$value->user_name}}</td>
                            <td>{{$value->role}}</td>
                            <td>{{$value->email}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('users');
                                if(in_array('edit',$permission))
                                    echo '<a  href="'.route("users.edit",$value->id).'" class="" title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                if(in_array('view',$permission))
                                    echo '<a  class="btn btn-small btn-primary" href="'.route('users.show', $value->id).'" title="View" ><span class="glyphicon glyphicon-search"></span>&nbsp;View</a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                if(in_array('edit',$permission))
                                {
                                    if($value->status){
                                        echo '<div class="btn btn-small btn-success" id="'.$value->id.'" onclick="statusUpdate(this.id)"><span id="ai'.$value->id.'"><i class="fa fa-check-circle"></i>&nbsp;Active</span></div>';
                                    }else{
                                        echo '<div class="btn btn-small btn-danger" id="'.$value->id.'" onclick="statusUpdate(this.id)"><span id="ai'.$value->id.'"><i class="fa fa-times-circle"></i>&nbsp;Inctive</span></div>';
                                    }
                                }?>
                            </td>
                         </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 function statusUpdate(id)
{
 $.ajax({
    type:'get',
    url:'/users/statusupdate/'+id,
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
@include('partials.table_script') 
@stop