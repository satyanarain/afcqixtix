@extends('layouts.master')
@section('header')
<h1>Manage Center Stock</h1>
<ol class="breadcrumb">
  <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="#">Inventory</a></li>
  <li><a href="/centerstock" >Center Stock</a></li>
  <li><a href="/centerstock.create" class="active">Create</a></li>
</ol>
@stop
@section('content')
@include('partials.message')
@include('partials.form_header')
                {!! Form::open([
                'route' => 'inventory.centerstock.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal'
                ]) !!}
                @include('inventory.centerstock.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@stop

