@extends('layouts.master')
@section('header')
<h3 class="box-title">Password Management</h3>
<ol class="breadcrumb">
       <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Change Password</a></li>
    </ol>

@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
     <div class="box">
            <div class="box-header">
             <h3 class="box-title">Change Password</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'changepasswords.store',
                'files'=>true,
                'autocomplete'=>'off',
                'enctype' => 'multipart/form-data'

                ]) !!}
                @include('changepasswords.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
@stop

