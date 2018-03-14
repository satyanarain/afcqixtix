@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
@include('partials.form_header')
                {!! Form::open([
                'route' => 'users.store',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                 'onSubmit'=>"return validateForm();",
                   'class'=>'form-horizontal',
                   'autocomplete'=>'0ff'
                ]) !!}
                @include('users.form')
<div class="form-group">
    <div class="col-md-3" style="margin-right: 15px;"></div>
    {{ Form::submit('Save', array('class' => 'btn btn-success pull-left')) }}
    <div class="col-md-9">
        <div class="col-md-7 col-sm-12">
        </div>
        <div class="col-md-9" style="padding-left: 0px;">
        </div>
    </div>
</div> 
                </br>
 {!! Form::close() !!}
  </div>
            <!-- /.box-body -->
  </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

