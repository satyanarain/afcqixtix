@extends('layouts.master')
@section('header')
<h1>Manage Center Stock</h1>
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
               <h3 class="box-title">Center Stock Inventories Details </h3>
                <?php 
                $permission_status = checkPermission('centerstocks','create');
                if($permission_status)
                {?>
                <a class="btn btn-primary pull-right" href="{{route('inventory.centerstock.create')}}"><span class="fa fa-plus"></span> Add</a>
                <?php   }?>
        
            @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                            <th>@lang('Items')</th>
                            <th>@lang('Denominations')</th>
                            <th>@lang('Series')</th>
                            <th>@lang('Start Sequence')</th>
                            <th>@lang('End Sequence')</th>
                            <th>@lang('Quantity')</th>
                            <th>@lang('Vendor Name')</th>
                            <th>@lang('Date Received')</th>
                            <th>@lang('Challan Number')</th>
                            <th>File (if any)</th>
                           {{  actionHeading('Action', $newaction='') }}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($centerstock as $value)
                        <tr class="nor_f">
                            <td>{{$value->name}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->series}}</td>
                            <td>{{$value->start_sequence}}</td>
                            <td>{{$value->end_sequence}}</td>
                            <td>{{$value->quantity}}</td>
                            <td>{{$value->vender_name}}</td>
                            <td>{{date('d-m-Y', strtotime($value->date_received))}}</td>
                            <td>{{$value->challan_no}}</td>
                            <td>
                                @if($value->fileupload)
                                <a href="{{URL::to('images/inventory/'.$value->fileupload)}}">
                                    Download
                                </a>
                                @else
                                {{'NA'}}
                                @endif
                            </td>
                            <td>
                                <?php $permission = getAllModulePermission('centerstocks');
                                if(in_array('edit',$permission)){
                                    echo '<a  href="'.route("inventory.centerstock.edit",$value->id).'" class="" title="Edit" ><span class="glyphicon glyphicon-pencil"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;';
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
@include('partials.table_script_order')
@stop