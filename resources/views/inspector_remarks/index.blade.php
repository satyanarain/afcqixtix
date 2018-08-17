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
                      
                           <th>@lang('Order Number')</th>
                            <th>@lang('Short Remarks')</th>
                            <th>@lang('Remarks Description')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($inspector_remarks as $value)
                        <tr class="nor_f">
                       
                            <td>{{$value->order_number}}</td>
                             <td>{{$value->short_remark}}</td>
                            <td>{{$value->remark_description}}</td>
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

@include('partials.inspector_remark_order_header')
@include('partials.table_script_order')
@stop
