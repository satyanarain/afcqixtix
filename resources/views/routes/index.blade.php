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
             {{createButton('create','Add')}}
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