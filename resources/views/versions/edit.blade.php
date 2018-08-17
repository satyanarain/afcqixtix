@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
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
