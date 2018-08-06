@extends('layouts.master')
@section('header')
<!--<h1>Manage Bus Type Services</h1>-->
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('bus_types.index')}}">Bus Types</a></li>
    <li><a href="{{route('bus_types.services.index',$bus_type_id)}}">Services</a></li>
    <li class="active">Add Service</li>
</ol>
@stop
@section('content')
  @include('partials.form_header')
                {!! Form::open([
                'route' => ['bus_types.services.store',$bus_type_id],
                'files'=>true,
                'enctype' => 'multipart/form-data',
                'class'=>'form-horizontal'
                ]) !!}
                @include('services.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

