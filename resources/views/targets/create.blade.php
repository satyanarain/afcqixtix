@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/route_master/">Routes</a></li>
    <li><a href="{{route('route_master.duties.index',$route_master_id,$duty_id)}}">Duty</a></li>
    <li><a href="{{route('route_master.duties.targets.index',[$route_master_id,$duty_id])}}">Target</a></li>
    <li class="active">Add Target</li>
</ol>
@stop
@section('content')
 @include('partials.form_header')
                {!! Form::open([
                'route' => ['route_master.duties.targets.store',$route_master_id,$duty_id],
                'files'=>true,
                 'class'=>'form-horizontal',
                 'autocomplete'=>'off',
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('targets.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

