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
             @if(Entrust::hasRole('administrator'))
                <a href="{{ route('vehicles.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
           @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('Vehicles Registration Number')</th>
                            <th>@lang('Bus Type')</th>
                             
                            <th>@lang('View')</th>
                            @if(Entrust::hasRole('administrator'))
                            <th>@lang('user.headers.edit')</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($vehicles as $value)
                        <tr class="nor_f">
                            <td>{{$value->name}}</td>
                            <td>{{$value->vehicle_registration_number}}
                            </td>
                            <td>{{$value->bus_type}}
                            </td>
                           <td> <a  class="btn btn-primary" href="{{ route('vehicles.show', $value->id) }}"><span class="glyphicon glyphicon-search"></span>View</a>
                          </td>
                              @if(Entrust::hasRole('administrator'))
                            <td>
                                <a  href="{{ route('vehicles.edit', $value->id) }}" class="btn btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                            </td>
                            @endif
                            
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

<script>
    $(function () {
        $("#example1").DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    });
 </script>  
@stop