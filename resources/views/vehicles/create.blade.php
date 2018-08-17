@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('depots.index')}}">Depots</a></li>
    <li><a href="{{route('depots.vehicles.index',$depot_id)}}">Vehicles</a></li>
    <li class="active">Add Vehicles</li>
</ol>
@stop
@section('content')
 @include('partials.form_header')
                {!! Form::open([
                'route' => ['depots.vehicles.store',$depot_id],
                'files'=>true,
                'class'=>'form-horizontal',
                'enctype' => 'multipart/form-data'

                ]) !!}
                @include('vehicles.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

