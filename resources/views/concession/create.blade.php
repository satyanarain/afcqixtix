@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
   
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{headingMain()}}</h3>
<<<<<<< HEAD:resources/views/concession/create.blade.php
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'concession.store',
                'files'=>true,
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('concession.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])
=======
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'concessions.store',
                'files'=>true,
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('concessions.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])
>>>>>>> 686d5283f8c735f021bc1e89df30650f954ac4d6:resources/views/concessions/create.blade.php

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

