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
	                <table id="example1" class="table table-bordered table-striped">
	                    <thead>
	                         <tr>
	                            <th>@lang('Items')</th>
	                            <th>@lang('Depot')</th>
	                            <th>Quantity</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach($summary as $value)
	                        <tr class="nor_f">
	                            <td>{{$value->item}}</td>
	                            <td>{{$value->depot}}</td>
	                            <td>{{$value->qty}}</td>
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