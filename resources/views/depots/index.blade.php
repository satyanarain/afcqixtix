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
                            <th class="display_none"></th>
                            <th>@lang('Depot Name')</th>
                            <th>@lang('Short Name')</th>
                            <th>@lang('Depot Location')</th>
                            <th>@lang('Action')</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($depots as $value)
                        <tr class="nor_f">
                            <td class="display_none"></td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->short_name}}
                            </td>
                            <td>{{$value->depot_location}}
                            </td>
                            <td>
                                <a  href="{{ route('depots.edit', $value->id) }}" class="btn btn-small btn-primary-edit" ><span class="glyphicon glyphicon-pencil"></span>Edit</a>
                                <button  class="btn btn-small btn-primary"  data-toggle="modal" data-target="#{{$value->id}}"><span class="glyphicon glyphicon-search"></span>View</button>
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

@include('partials.table_script')
@stop

@foreach($depots as $value)
<div class="modal fade" id="{{$value->id}}" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:10px 50px; background-color:#3c8dbc; color:#fff;font-weight:bold;font-size:30px;">
                <button type="button" class="close" data-dismiss="modal"><font class="white">&times;</font></button>
                <h4 style=" color:#fff;font-weight:bold;font-size:20px;"><span class="fa fa-bus"></span> Depot Details</h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;" >
                <table width=90% class="table table-responsive" style="font-family: 'Source Sans Pro','Helvetica Neue',Helvetica,Arial,sans-serif; font-size:15px;">
                    <tr>
                        <td><b>Depot Name</b></td>
                        <td class="table_normal">{{ $value->name }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Short Name</b></td>
                        <td class="table_normal">{{ $value->short_name }}</span></td>
                    </tr>
                    <tr>
                        <td><b>Depot Location</b></td>
                        <td class="table_normal">{{ $value->depot_location }}</td>
                    </tr>
                    <tr>
                        <td><b>Default Service</b></td>
                        <td class="table_normal">{{ $value->default_service }}</td>
                    </tr>
                </table>  

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
@endforeach
