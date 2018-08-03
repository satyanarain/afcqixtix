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
             {{ createButton('create','Add') }}
            </div>
           @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Denomination Type')</th>
                            <th>@lang('Description')</th>
                            <th>@lang('Price')</th>
                             {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($denominations as $value)
                        <tr class="nor_f">
                            <td>{{$value->denomination_master_id}}</td>
                             <td>{{$value->description}}</td>
                            <td>{{$value->price}}</td>
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
@include('partials.denominationsheader')
@include('partials.table_script')
@stop
