@extends('layouts.master')
@section('header')
<h1>Manage Depot Crew</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('depots.index')}}">Depots</a></li>
    <li><a href="{{route('depots.crew.index',$depot_id)}}">Crew</a></li>
    <li class="active">Add Crew</li>
</ol>
@stop
@section('content')
@include('partials.form_header')
                {!! Form::open([
                'route' => ['depots.crew.store',$depot_id],
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal',
                 'onSubmit'=>"return validateForm();"
                ]) !!}
                @include('crew.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        </div>
        </div>
        <!-- /.box -->

    <!-- /.col -->


@stop

