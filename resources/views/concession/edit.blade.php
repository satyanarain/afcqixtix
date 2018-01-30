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
           </div>
            <!-- /.box-header -->
            <div class="box-body">
<<<<<<< HEAD:resources/views/concession/edit.blade.php
               {!! Form::model($concession, [
        'method' => 'PATCH',
        'route' => ['concession.update', $concession->id],
        'files'=>true,
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('concession.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])
=======
               {!! Form::model($concessions, [
        'method' => 'PATCH',
        'route' => ['concessions.update', $concessions->id],
        'files'=>true,
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('concessions.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])
>>>>>>> 686d5283f8c735f021bc1e89df30650f954ac4d6:resources/views/concessions/edit.blade.php

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
