@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/routes">Routes</a></li>
    <li><a href="{{route('routes.duties.index',$route_id,$duty_id)}}">Duties</a></li>
    <li><a href="{{route('routes.duties.targets.index',[$route_id,$duty_id])}}">Target</a></li>
    <li class="active">Update Target</li>
</ol>
@stop
@section('content')
 @include('partials.form_header')
               {!! Form::model($targets, [
        'method' => 'PATCH',
        'route' => ['routes.duties.targets.update',$route_id,$duty_id,$targets->id],
        'files'=>true,
         'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('targets.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
