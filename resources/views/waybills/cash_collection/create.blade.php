@extends('layouts.master')
@section('header')
<h1>Cash Collection</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Cash Collection</li>
</ol>
@stop
@section('content')
@include('partials.form_header')
                {!! Form::open([
                'route' => 'waybills.storecash',
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                 'onSubmit'=>"return validateForm();"
                ]) !!}
                @include('waybills.cash_collection.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        </div>
        <!-- /.box -->

    <!-- /.col -->


@stop