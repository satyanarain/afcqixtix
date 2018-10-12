@extends('layouts.master')
@section('header')
<h1>Manage Version Control</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('versions.index')}}">Version</a></li>
    <li class="active">Update Version</li>
</ol>
@stop
@section('content')
  @include('partials.form_header')
               {!! Form::model($version, [
        'method' => 'PATCH',
        'route' => ['versions.update', $versions->id],
        'files'=>true,
        'class'=>'form-horizontal',
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('versions.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
