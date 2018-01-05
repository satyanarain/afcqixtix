@extends('layouts.master')
@section('header')
<h1>Duty Management {{--headingBold()--}}</h1>
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
               {!! Form::model($duties, [
        'method' => 'PATCH',
        'route' => ['duties.update', $duties->id],
        'files'=>true,
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('duties.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
