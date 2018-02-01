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
                            <th>@lang('Bus Type')</th>
                            <th>@lang('Order Number')</th>
                            <th>@lang('Abbreviation')</th>
                            
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bustypes as $value)
                        <tr class="nor_f">
                            <td>{{$value->bus_type}}</td>
                             <td>{{$value->order_number}}
                            </td>
                            <td>{{$value->abbreviation}}
                            </td>
                           
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
 </div>

<!-- /.row -->

@include('partials.bustypes_order_header')
@include('partials.bustypesheader')
@include('partials.table_script_order')
@stop