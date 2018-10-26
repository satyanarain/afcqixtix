@extends('layouts.master')
@section('header')
<h1>Manage Crew Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Inventories</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">Crew Stock Inventories Details </h3>
                <?php 
                $permission_status = checkPermission('crewstocks','create');
                if($permission_status)
                {?>
                <a class="btn btn-primary pull-right" href="{{route('inventory.crewstock.create')}}"><span class="fa fa-plus"></span> Add</a>
                <?php   }?>
        
            @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Items')</th>
                            <th>@lang('Depot')</th>
                            <th>@lang('Crew')</th>
                            <th>@lang('Denominations')</th>
                            <th>@lang('Series')</th>
                            <th>@lang('Start Sequence')</th>
                            <th>@lang('End Sequence')</th>
                            <th>@lang('Quantity')</th>
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $value)
                        <tr class="nor_f">
                            <td>{{$value->name}}</td>
                            <td>{{$value->depot_name}}</td>
                            <td>{{$value->crew_name}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->series}}</td>
                            <td>{{$value->start_sequence}}</td>
                            <td>{{$value->end_sequence}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>
                                <?php $permission = getAllModulePermission('crewstocks');
                                if(in_array('edit',$permission)){
                                    echo '<a  href="'.route("inventory.crewstock.edit",$value->id).'" class="" title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
                                }elseif(in_array('edit',$permission)){?>
                                        <a class="disabled"><span class="glyphicon glyphicon-pencil "></span></a>&nbsp;&nbsp;&nbsp;&nbsp;   
                                <?php }?>
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
 </div>

<!-- /.row -->

@include('partials.bustypes_order_header')
@include('partials.table_script_order')
@stop