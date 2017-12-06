@extends('layouts.master')
@section('header')
@php  headingBold(); @endphp
@php  BreadCrumb(); @endphp
@stop
@section('content')
<div class="row">
    <div class="col-xs-12">
   
        <div class="box">
            <div class="box-header">
               @php  headingMain(); @endphp
                <a href="{{ route('users.create')}}"><button class="btn btn-primary pull-right"><i class="fa fa-plus"></i>   @lang('common.titles.add')</button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open([
        'route' => 'users.store',
        'files'=>true,
        'enctype' => 'multipart/form-data'

        ]) !!}
                @include('users.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</div>
@stop

