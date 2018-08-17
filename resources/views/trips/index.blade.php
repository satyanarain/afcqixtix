@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/routes/">Routes</a></li>
    <li><a href="{{route('routes.duties.index',$route_id,$duty_id)}}">Duty</a></li>
    <li class="active">Trips</li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{getCurrentLabel('duties','id',$duty_id,'duty_number')}} :- {{headingMain()}}</h3>
             <a href="{{route('routes.duties.trips.create',[$route_id,$duty_id])}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Route')</th>
                           <th>@lang('Duty')</th>
                           <th>@lang('Shift')</th>
                          {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($trips as $value)
                        <tr class="nor_f">
                            <td>{{displayIdBaseName('routes',$value->route_id,'route')}}</td>
                            <td>{{$value->duty_number}}</td>
                            <td>{{$value->shift}}</td>
                            <td>
                                <a href="<?php echo route('routes.duties.trips.edit',[$route_id,$duty_id,$value->id])?>" title="Edit Trip"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a style="cursor: pointer;" title="View Trip" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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
   var urldata=   '/trips/' + view_detail + '/' +id;
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


@include('partials.table_script')
@stop