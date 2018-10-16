@extends('layouts.master')
@section('header')
<h1>Manage Depot Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Inventories</a></li>
  <li><a href="{{route('inventory.depotstock.index')}}" >Depot Stock</a></li>
  <li><a href="#" class="active">Create</a></li>
</ol>
@stop
@section('content')
@include('partials.form_header')
                {!! Form::open([
                'route' => 'inventory.depotstock.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'onsubmit'=>'return validateForm();'
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

