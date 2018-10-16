@extends('layouts.master')
@section('header')
<h1>Manage Return Crew Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Inventories</a></li>
  <li><a href="{{route('inventory.returncrewstock.index')}}" >Return Crew Stock</a></li>
  <li><a href="#" class="active">Edit</a></li>
</ol>
@stop
@section('content')
@include('partials.form_header')
                {!! Form::model($stock, [
                'route' => ['inventory.depotstock.update', $stock->id],
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'method'=>'PUT'
                ]) !!}
                @include('inventory.depotstock.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@stop

