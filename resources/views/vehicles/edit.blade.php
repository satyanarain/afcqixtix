@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('depots.index')}}">Depots</a></li>
    <li><a href="{{route('depots.vehicles.index',$depot_id)}}">Vehicles</a></li>
    <li class="active">Update Vehicles</li>
</ol>
@stop
@section('content')
 @include('partials.form_header')
               {!! Form::model($vehicles, [
        'method' => 'PATCH',
        'route' => ['depots.vehicles.update',$depot_id,$vehicles->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
        'class'=>'form-horizontal'
        ]) !!}
               @include('vehicles.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
