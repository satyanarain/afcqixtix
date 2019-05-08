@extends('layouts.master')
@section('header')
<h1>Inventory Summary</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Inventory Summary</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
      	<div class="box">
            <div class="box-header">
               <h3 class="box-title">Depot Stock Inventory Summary </h3>
            </div>
            <div class="box-body">
            	<div class="box-body">
	                <table id="tableWithFilter" class="table table-bordered table-striped">
	                    <thead>
	                         <tr>
	                            <th>@lang('Items')</th>
	                            <th>@lang('Depot')</th>
	                            <th>@lang('Denomination')</th>
	                            <th>@lang('Series')</th>
	                            <th class="text-right">Quantity</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($summary as $value)
	                        <tr class="nor_f">
	                            <td>{{$value->item}}</td>
	                            <td>{{$value->depot}}</td>
	                            <td>
	                            	@if($value->denom)
	                            	{{$value->denom}}
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
	                            <td class="text-right">{{$value->qty}}</td>
	                        </tr>
	                        @endforeach
	                    </tbody>
	                </table>
            	</div>
            </div>
        </div>
    </div>
</div>
@endsection