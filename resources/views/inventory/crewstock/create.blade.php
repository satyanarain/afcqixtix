@extends('layouts.master')
@section('header')
<h1>Manage Crew Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Inventories</a></li>
  <li><a href="{{route('inventory.crewstock.index')}}" >Crew Stock</a></li>
  <li><a href="#" class="active">Create</a></li>
</ol>
@stop
@section('content')
@include('partials.form_header')
                {!! Form::open([
                'route' => 'inventory.crewstock.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                'onsubmit'=>'return validateForm();'
                ]) !!}
                @include('inventory.crewstock.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@stop

