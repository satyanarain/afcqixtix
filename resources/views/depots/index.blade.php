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
                <a href="{{ route('depots.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
                @endif
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('Short Name')</th>
                            <th>@lang('Depot Location')</th>
                            <th>@lang('View')</th>
                            @if(Entrust::hasRole('administrator'))
                            <th>@lang('user.headers.edit')</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($depots as $value)
                        <tr class="nor_f    ">
                            <td>{{$value->name}}</td>
                            <td>{{$value->short_name}}
                            </td>
                            <td>{{$value->depot_location}}
                            </td>
                           <td> <a  class="btn btn-primary" href="{{ route('depots.show', $value->id) }}"><span class="glyphicon glyphicon-search"></span>View</a>
                          </td>
                              @if(Entrust::hasRole('administrator'))
                            <td>
                                <a  href="{{ route('depots.edit', $value->id) }}" class="btn btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
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
        // $("#example1").DataTable();
     $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
    // "order": [[ 9, "asc" ], [ 10, "asc" ]],
       "order":[["id", "desc"]],
      "ordering":true,
      "info": true,
      "autoWidth": false
    });
    });
 </script>  
@stop