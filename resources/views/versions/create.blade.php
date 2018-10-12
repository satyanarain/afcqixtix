@extends('layouts.master')
@section('header')
<h1>Manage Version Control</h1>
<ol class="breadcrumb">
    <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{route('versions.index')}}">Versions</a></li>
    <li class="active">Create Version</li>
</ol>
@stop
@section('content')
  @include('partials.form_header')
                {!! Form::open([
                'route' => 'versions.store',
                'files'=>true,
                'class'=>'form-horizontal',
                'enctype' => 'multipart/form-data'
                 ]) !!}
                @include('versions.form', ['submitButtonText' => Lang::get('user.headers.create_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop

