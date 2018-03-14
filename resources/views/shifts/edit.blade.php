@extends('layouts.master')
@section('header')
<h1>{{headingBold()}}</h1>
{{BreadCrumb()}}
@stop
@section('content')
   @include('partials.form_header')
               {!! Form::model($shifts, [
        'method' => 'PATCH',
        'route' => ['shifts.update', $shifts->id],
        'class'=>'form-horizontal',
        'files'=>true,
        'enctype' => 'multipart/form-data'
        ]) !!}
               @include('shifts.form', ['submitButtonText' => Lang::get('user.headers.update_submit')])

                {!! Form::close() !!}
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>

@stop
