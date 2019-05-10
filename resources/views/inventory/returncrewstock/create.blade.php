@extends('layouts.master')
@section('header')
<h1>Manage Return Crew Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Inventory</a></li>
  <li><a href="{{route('inventory.returncrewstock.index')}}" >Return Crew Stock</a></li>
  <li><a href="#" class="active">Create</a></li>
</ol>
@stop
@section('content')
@include('partials.form_header')
                {!! Form::open([
                'route' => 'inventory.returncrewstock.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('inventory.returncrewstock.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@stop

