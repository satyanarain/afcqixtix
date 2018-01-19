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
              <a href="{{ route('targets.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
           </div>
            <!-- /.box-header -->
            <div class="box-body">
                {!! Form::open([
                'route' => 'targets.store',
                'files'=>true,
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('targets.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

