@extends('layouts.master')
@section('header')
<h1>Manage Return Crew Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Inventory</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      <div class="box">
            <div class="box-header">
               <h3 class="box-title">Return Crew Stock Inventory Details </h3>
                <?php 
                $permission_status = checkPermission('returncrewstocks','create');
                if($permission_status)
                {?>
                <a class="btn btn-afcs pull-right" href="{{route('inventory.returncrewstock.create')}}"><span class="fa fa-plus"></span> Return</a>
                <?php   }?>
        
            @include('partials.message')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="tableWithFilter" class="table table-bordered table-striped">
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
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stocks as $value)
                        <tr class="nor_f">
                            <td>{{$value->name}}</td>
                            <td>{{$value->depot_name}}</td>
                            <td>{{$value->crew_name}}</td>
                            <td>
                                @if($value->description)
                                {{$value->description}}
                                @else
                                {{'N/A'}}
                                @endif
                            </td>
                            <td>
                                @if($value->series)
                                {{$value->series}}
                                @else
                                {{'N/A'}}
                                @endif
                            </td>
                            <td>
                                @if($value->start_sequence)
                                {{$value->start_sequence}}
                                @else
                                {{'N/A'}}
                                @endif
                            </td>
                            <td>
                                @if($value->end_sequence)
                                {{$value->end_sequence}}
                                @else
                                {{'N/A'}}
                                @endif
                            </td>
                            <td>{{$value->quantity}}</td>
                            <td>
                                {{date('d-m-Y H:i:s', strtotime($value->created_at))}}
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
@stop