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
                            <th>@lang('Service Name')</th>
                            <th>@lang('Order Number')</th>
                           <th>@lang('Pass Provider')</th>
                            <th>@lang('Pass Type')</th>
                            <th>@lang('Description')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                     @foreach($pass_types as $value)
                        <tr class="nor_f">
                            <td>{{$value->name}}</td>
                             <td>{{$value->order_number}}</td>
                            <td>{{$value->concession_provider_master_id}}</td>
                            <td>{{$value->type_name}}</td>
                            <td>{{$value->description}}</td>
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
@include('partials.pass_types_order_header')
@include('partials.pass_typesheader')
@include('partials.table_script_order')
@stop