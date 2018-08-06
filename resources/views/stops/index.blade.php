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
                            <th>@lang('Stop')</th>
                            <th>@lang('Stop ID')</th>
                            <th>@lang('Abbreviation')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stops as $value)
                        <tr class="nor_f    ">
                            <td>{{$value->stop}}</td>
                            <td>{{$value->stop_id}}
                            </td>
                            <td>{{$value->abbreviation}}
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
@include('partials.stopsheader')
@include('partials.table_script') 
@stop