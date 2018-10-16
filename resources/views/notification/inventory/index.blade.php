@extends('layouts.master')
@section('header')
<h1>Manage Inventory Notification</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#" class="active">Inventory Notification</a></li>
</ol>
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
        <h4>Central stock</h4>
    </div>

    <div class="col-xs-12">
        <h4>Depot stock</h4>
    </div>
</div>
</div>

@include('partials.bustypes_order_header')
@include('partials.table_script_order')
@stop