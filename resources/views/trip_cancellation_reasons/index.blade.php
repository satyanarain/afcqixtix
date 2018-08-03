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
             {{ createButton('create','Add','Add'.'order_id') }}
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Trip Cancellation Reason')</th>
                           <th>@lang('Order Number')</th>
                            <th>@lang('Short Reason')</th>
                            <th>@lang('Reason Description')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($trip_cancellation_reasons as $value)
                        <tr class="nor_f">
                            <td>{{$value->trip_cancellation_reason_category_master_id}}</td>
                            <td>{{$value->order_number}}</td>
                             <td>{{$value->short_reason}}</td>
                            <td>{{$value->reason_description}}</td>
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

@include('partials.trip_cancellation_reason_order_header')
@include('partials.table_script_order')
@stop
