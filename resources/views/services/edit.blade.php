@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('bus_types.index')}}">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id)}}">Services</a></li>
    <li class="active">Update Service</li>
</ol>
@stop
@section('content')
  @include('partials.form_header')
               {!! Form::model($services, [
        'method' => 'PATCH',
        'route' => ['bus_types.services.update',$bus_type_id,$services->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
         'class'=>'form-horizontal'
        ]) !!}
               @include('services.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
