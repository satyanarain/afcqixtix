@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/bus_types">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id,$service_id)}}">Services</a></li>
    <li><a href="{{route('bus_types.services.concessions.index',[$bus_type_id,$service_id])}}">Concessions</a></li>
    <li class="active">Add Concessions</li>
</ol>
@stop
@section('content')
  @include('partials.form_header')
                {!! Form::open([
                'route' => ['bus_types.services.concessions.store',$bus_type_id,$service_id],
                'files'=>true,
                'class'=>'form-horizontal',
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('concessions.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

