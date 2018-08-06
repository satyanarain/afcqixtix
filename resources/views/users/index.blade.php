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
             @include('partials.message')
            <!-- /.box-header -->
            <div class="panel-body">
               <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="display_none"></th>
                            <th>@lang('user.headers.name')</th>
                            <th>@lang('User Name')</th>
                            <th>@lang('Role')</th>
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
                                {{ actionEdit('edit',$value->id,$value->status)}}
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