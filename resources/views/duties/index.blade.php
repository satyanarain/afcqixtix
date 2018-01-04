@extends('layouts.master')
@section('header')
<h1>Duty Management {{--headingBold()--}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">{{headingMain()}}</h3>
             @if(Entrust::hasRole('administrator'))
                <a href="{{ route('duties.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
           @endif
            </div>
          @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Route')</th>
                            <th>@lang('Duty Number')</th>
                           <th>@lang('Start Time')</th>
                            <th>@lang('Shift')</th>
                            <th>@lang('View')</th>
                            @if(Entrust::hasRole('administrator'))
                            <th>@lang('user.headers.edit')</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($duties as $value)
                        <tr class="nor_f">
                            <td>{{$value->route}}</td>
                            <td>{{$value->duty_number}}
                            </td>
                            <td>{{$value->start_time}}
                            </td>
                            
                            <td>{{$value->shift}}
                            </td>
                            
                            
                           <td> <a  class="btn btn-primary" href="{{ route('duties.show', $value->id) }}"><span class="glyphicon glyphicon-search"></span>View</a>
                          </td>
                              @if(Entrust::hasRole('administrator'))
                            <td>
                                <a  href="{{ route('duties.edit', $value->id) }}" class="btn btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span> Edit</a>
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
      "lengthChange": true,
      "searching": true,
      "ordering": ['id', "desc"],
      "info": true,
      "autoWidth": false
    });
    });
 </script>  
@stop