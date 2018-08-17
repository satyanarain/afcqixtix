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
             {{ createButton('create','Add','order','order_id') }}
            </div>
          @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Shift')</th>
                            <th>@lang('Order Number')</th>
                            <th>@lang('Start Time')</th>
                            <th>@lang('End Time')</th>
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($shifts as $value)
                        <tr class="nor_f">
                            <td>{{$value->shift}}</td>
                            <td>{{$value->order_number}}</td>
                            <td>{{displayView($value->start_time)}}
                            </td>
                            <td>{{displayView($value->end_time)}}
                            </td>
                            <td>
                                {{ actionEdit('edit',$value->id)}}
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
@include('partials.shifts_order_header')
@include('partials.table_script')  
@stop