@extends('layouts.master')
@section('header')
<h1>Manage Depot Crew</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('depots.index')}}">Depots</a></li>
    <li><a href="{{route('depots.crew.index',$depot_id)}}">Crew</a></li>
    <li class="active">Update Crew</li>
</ol>
@stop
@section('content')
@include('partials.form_header')
               {!! Form::model($crew_details, [
        'method' => 'PATCH',
        'route' => ['depots.crew.update',$depot_id,$crew_details->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
         'class'=>'form-horizontal'
        ]) !!}
               @include('crew.form', ['submitButtonText' => Lang::get('crew_details.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
