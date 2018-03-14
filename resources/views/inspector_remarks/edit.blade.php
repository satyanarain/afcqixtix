@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
  @include('partials.form_header')
               {!! Form::model($inspector_remarks, [
        'method' => 'PATCH',
        'route' => ['inspector_remarks.update', $inspector_remarks->id],
        'files'=>true,
        'enctype' => 'multipart/form-data',
        'class'=>'form-horizontal',
        'autocomplete'=>'0ff'
        ]) !!}
               @include('inspector_remarks.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
