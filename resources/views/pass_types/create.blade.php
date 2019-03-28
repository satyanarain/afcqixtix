@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li><a href="{{route('bus_types.services.pass_types.index',[$bus_type_id,$service_id])}}">Pass Types</a></li>
    <li class="active">Add Pass Type</li>
</ol>
@stop
@section('content')
 @include('partials.form_header')
                {!! Form::open([
                'route' => ['bus_types.services.pass_types.store',$bus_type_id,$service_id],
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal'
                 ]) !!}
                @include('pass_types.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

