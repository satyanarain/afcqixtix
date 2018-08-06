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
               <h3 class="box-title">{{getCurrentLabel('routes','id',$route_id,'route')}} :- {{headingMain()}}</h3>
             <a href="<?php echo route('routes.duties.targets.create',[$route_id,$duty_id])?>"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>&nbsp;Add</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
<!--                            <th>@lang('Route')</th>-->
                            <th>@lang('Duty Number')</th>
                           <th>@lang('Start Time')</th>
                            <th>@lang('Shift')</th>
                            {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                         @foreach($targets as $value)
                        <tr class="nor_f">
<!--                            <td>{{$value->route}}</td>-->
                            <td>{{$value->duty_number}}
                            </td>
                            <td>{{$value->start_time}}
                            </td>
                            
                            <td>{{$value->shift}}
                            </td>
                            <td>
                                <a href="<?php echo route('routes.duties.targets.edit',[$route_id,$duty_id,$value->id])?>" title="Edit Target"><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a style="cursor: pointer;" title="View Trip" data-toggle="modal" data-target="#<?php echo $value->id ?>"  onclick="viewDetails(<?php echo $value->id ?>,'view_detail');"><span class="glyphicon glyphicon-search"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;
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

@include('partials.targetsheader')
@include('partials.table_script')
@stop